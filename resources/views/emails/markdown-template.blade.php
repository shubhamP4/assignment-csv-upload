@component('mail::message')
# {{ $details['title'] }}

The csv data has been uploaded successfully.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
