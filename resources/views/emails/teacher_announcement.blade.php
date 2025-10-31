@component('mail::message')
# {{ $title }}

{{ $body }}

Regards,<br>
{{ $author }}
@endcomponent
