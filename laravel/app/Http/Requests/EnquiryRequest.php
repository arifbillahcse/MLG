<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120'],

            // Bangladeshi mobile: 01[3-9] then eight digits. Spaces, dashes and a
            // +88 / 88 prefix are stripped in prepareForValidation().
            'phone' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],

            'email' => ['nullable', 'email:rfc', 'max:190'],
            'interest' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:5000'],

            'event_id' => ['nullable', Rule::exists('events', 'id')->where('is_active', true)],

            'details' => ['nullable', 'array', 'max:6'],
            'details.*' => ['nullable', 'string', 'max:160'],

            'source_form' => ['nullable', 'string', 'max:60'],
            'source_page' => ['nullable', 'string', 'max:190'],

            // Honeypot. A real person never sees this field, so anything in it
            // is a bot and the request fails validation.
            'website' => ['prohibited'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $phone = preg_replace('/[\s\-()]/', '', (string) $this->input('phone'));
        $phone = preg_replace('/^(?:\+?88)/', '', $phone);

        $this->merge(['phone' => $phone]);
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Enter a valid Bangladeshi mobile number, for example 01712345678.',
            'website.prohibited' => 'That submission could not be accepted.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name',
            'phone' => 'mobile number',
        ];
    }
}
