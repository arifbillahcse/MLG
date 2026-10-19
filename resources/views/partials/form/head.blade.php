{{-- Shared opening for every enquiry form: CSRF, provenance, honeypot. --}}
@csrf
<input type="hidden" name="source_form" value="{{ $form }}">
<input type="hidden" name="source_page" value="{{ url()->current() }}">
@isset($eventId)
    <input type="hidden" name="event_id" value="{{ $eventId }}">
@endisset

{{-- Honeypot. Hidden from people and from screen readers; bots fill it in
     and the request is rejected by the prohibited rule. --}}
<div class="hp" aria-hidden="true">
    <label for="website-{{ $form }}">Leave this field empty</label>
    <input type="text" id="website-{{ $form }}" name="website" tabindex="-1" autocomplete="off">
</div>
