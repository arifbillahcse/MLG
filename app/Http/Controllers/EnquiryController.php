<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Mail\EnquiryReceived;
use App\Models\Enquiry;
use App\Models\Event;
use App\Support\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * One endpoint behind all eight forms on the site.
 *
 * Every form posts natively, so it works with JavaScript disabled; main.js
 * upgrades that to fetch() for inline feedback and falls back to a normal
 * submit if the request fails.
 */
class EnquiryController extends Controller
{
    public function store(EnquiryRequest $request): RedirectResponse|JsonResponse
    {
        $data = $request->validated();

        $enquiry = Enquiry::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'interest' => $data['interest'] ?? null,
            'message' => $this->composeMessage($data),
            'source_form' => $data['source_form'] ?? null,
            'source_page' => $data['source_page'] ?? $request->headers->get('referer'),
            'status' => 'new',
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]);

        // A form carrying an event registers the person for it as well, so the
        // seminar and mock-test screens show who is coming.
        if (! empty($data['event_id'])) {
            $this->registerForEvent($enquiry, (int) $data['event_id']);
        }

        $this->notify($enquiry);

        $message = 'Thank you. We will call you within one working day.';

        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'message' => $message]);
        }

        return back()
            ->with('enquiry_status', $message)
            ->with('enquiry_form', $data['source_form'] ?? null);
    }

    /** Fold the per-form extras into the message so nothing is lost. */
    protected function composeMessage(array $data): ?string
    {
        $parts = [];

        if (! empty($data['message'])) {
            $parts[] = trim($data['message']);
        }

        foreach ($data['details'] ?? [] as $label => $value) {
            if (filled($value)) {
                $parts[] = ucfirst(str_replace('_', ' ', (string) $label)).': '.$value;
            }
        }

        return $parts ? implode("\n\n", $parts) : null;
    }

    protected function registerForEvent(Enquiry $enquiry, int $eventId): void
    {
        $event = Event::find($eventId);

        if (! $event) {
            return;
        }

        $event->registrations()->create([
            'name' => $enquiry->name,
            'phone' => $enquiry->phone,
            'email' => $enquiry->email,
            'interest' => $enquiry->interest,
        ]);
    }

    /** A failed mail must never cost us the enquiry — it is already saved. */
    protected function notify(Enquiry $enquiry): void
    {
        $to = Site::get('email');

        if (! $to) {
            return;
        }

        try {
            Mail::to($to)->send(new EnquiryReceived($enquiry));
        } catch (\Throwable $e) {
            Log::error('Enquiry notification failed', [
                'enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
