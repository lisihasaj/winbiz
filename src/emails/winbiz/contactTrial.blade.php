@php
    $fields = array(
        (object) [
            'key' => 'emails.gender',
            'value' => $__data['gender']
        ],
        (object) [
            'key' => 'emails.forename',
            'value' => $__data['first_name']
        ],
        (object) [
            'key' => 'emails.name',
            'value' => $__data['last_name']
        ],
        (object) [
            'key' => 'emails.email.address',
            'value' => $__data['email']
        ],
        (object) [
            'key' => 'emails.telephone',
            'value' => $__data['telephone']
        ],
        (object) [
            'key' => 'emails.secondary.telephone',
            'value' => $__data['secondTelephone']
        ],
        (object) [
            'key' => 'emails.zip_code',
            'value' => $__data['npa']
        ],
        (object) [
            'key' => 'emails.city',
            'value' => $__data['city']
        ]
    );
@endphp

<p><strong>{{ __('emails.winbiz.message-from')}} :</strong></p>
@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach