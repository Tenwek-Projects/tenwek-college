New School of Chaplaincy online application (submission #{{ $submission->id }})

@php
    $p = $submission->payload ?? [];
    $skip = ['bank_slip_path', 'photograph_path', 'photograph_2_path', 'photograph_3_path', 'certificates_path', 'english_proof_path'];
@endphp
@foreach($p as $key => $value)
@if(! in_array($key, $skip, true))
{{ str_replace('_', ' ', (string) $key) }}: {{ is_scalar($value) || $value === null ? (string) $value : json_encode($value) }}
@endif
@endforeach

Uploaded files are attached to this message when available.
Admin: review form submissions in the SOC CMS.
