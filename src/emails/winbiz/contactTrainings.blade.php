@php
    $fields = array(
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
            'key' => 'emails.mailing_address',
            'value' => $__data['address']
        ],
        (object) [
            'key' => 'emails.client.id',
            'value' => $__data['customer_number']
        ],
        (object) [
            'key' => 'emails.zip_code',
            'value' => $__data['zip_code']
        ],
        (object) [
            'key' => 'emails.locality',
            'value' => $__data['city']
        ],
        (object) [
            'key' => 'emails.social.reason',
            'value' => $__data['company_name']
        ],
        (object) [
            'key' => 'emails.nr_of_participants',
            'value' => $__data['nr_of_participants']
        ],
        (object) [
            'key' => 'emails.participants',
            'value' => $__data['participants']
        ],
        (object) [
            'key' => 'emails.language',
            'value' => $__data['language']
        ],
        (object) [
            'key' => 'emails.training_name',
            'value' => $__data['training_name']
        ]
    );
@endphp

<p><strong>{{ __('emails.winbiz.message-from')}} :</strong></p>
@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach

@if(isset($location))
    @include('emails.winbiz.common.paragraphKeyValue', ['key' => 'location', 'value' => $location])
@endif

@if(isset($dates))
    @foreach($dates as $key => $date)
        <p><strong>{{$key}}:</strong> {!! $date !!}</p>
    @endforeach
@endif