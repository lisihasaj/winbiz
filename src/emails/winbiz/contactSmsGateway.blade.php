@php
    $fields = array(
        (object) [
            'key' => 'emails.social.reason',
            'value' => $__data['company_name']
        ],
        (object) [
            'key' => 'emails.client.id',
            'value' => $__data['customer_number']
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
            'value' => $__data['phone']
        ],
        (object) [
            'key' => 'emails.units',
            'value' => $__data['units']
        ]
    );
@endphp

<p><strong>{{ __('emails.winbiz.message-from')}} :</strong></p>
@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach