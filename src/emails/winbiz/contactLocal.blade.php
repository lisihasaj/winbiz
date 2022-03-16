@php
    $fields = array(
        (object) [
            'key' => 'emails.social.reason',
            'value' => $__data['socialReason']
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
            'key' => 'emails.street',
            'value' => $__data['street']
        ],
        (object) [
            'key' => 'emails.number',
            'value' => $__data['streetNumber']
        ],
        (object) [
            'key' => 'emails.additional.address',
            'value' => $__data['additionalAddress']
        ],
        (object) [
            'key' => 'emails.zip_code',
            'value' => $__data['npa']
        ],
        (object) [
            'key' => 'emails.locality',
            'value' => $__data['locality']
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
            'key' => 'emails.partner.package',
            'value' => $__data['sellingPartner']
        ]
    );

@endphp

<p><strong>{{ __('emails.winbiz.message-from')}}:</strong></p>
@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach

<p>Date: <strong>{{now()->toDateString()}}</strong></p>
<p>Version: <strong>Winbiz Local</strong></p>

<p>
    Winbiz Local CD:
    @if($vipSubscription)
        <strong>
            CHF 86.25
        </strong>
    @else
        <strong>
            CHF 79
        </strong>
    @endif
</p>

@if($vipSubscription)
<p>
    {{ __('emails.support.telephone.local')}} V.I.P. :
    <strong>CHF 15.-</strong>
</p>
<p>
    Total: 
    <strong>CHF 101.25</strong>
</p>
@else 
<p>
    Total: 
    <p>CHF 85.10</p>
</p>
@endif