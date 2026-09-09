COHS programme application: {{ $programme }} (submission #{{ $submission->id }})

@php
    $p = $submission->payload ?? [];
@endphp
@foreach($p as $key => $value)
@if(! str_ends_with((string) $key, '_path'))
{{ str_replace('_', ' ', (string) $key) }}: {{ is_scalar($value) || $value === null ? (string) $value : json_encode($value) }}
@endif
@endforeach

Uploaded files are attached to this message when available.
Admin: review form submissions in the COHS CMS.
