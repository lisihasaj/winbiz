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
            'key' => 'emails.client.id',
            'value' => $__data['clientId']
        ],
        (object) [
            'key' => 'emails.message',
            'value' => $__data['message']
        ]
    );
@endphp

<p>{{ __('emails.winbiz.message-from')}}</p>
@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach