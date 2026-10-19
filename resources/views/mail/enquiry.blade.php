<x-mail::message>
# New enquiry

**{{ $enquiry->name }}** got in touch through the website.

<x-mail::panel>
**Phone:** {{ $enquiry->phone }}
@if ($enquiry->email)
**Email:** {{ $enquiry->email }}
@endif
@if ($enquiry->interest)
**Interested in:** {{ $enquiry->interest }}
@endif
**Form:** {{ $enquiry->source_form }}
**Page:** {{ $enquiry->source_page }}
</x-mail::panel>

@if ($enquiry->message)
{{ $enquiry->message }}
@endif

<x-mail::button :url="url('/admin/enquiries/'.$enquiry->id.'/edit')">
Open in admin
</x-mail::button>

Received {{ $enquiry->created_at->format('j M Y, g:i a') }}.
</x-mail::message>
