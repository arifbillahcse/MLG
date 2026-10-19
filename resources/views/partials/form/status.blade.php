{{-- Server-rendered outcome. main.js writes into the same element when it
     handles the submit with fetch, so there is one place for feedback. --}}
<p class="form__status @if (session('enquiry_form') === $form) is-ok @elseif ($errors->any()) is-err @endif"
   role="status" aria-live="polite">
    @if (session('enquiry_form') === $form)
        {{ session('enquiry_status') }}
    @elseif ($errors->any())
        {{ $errors->first() }}
    @endif
</p>
