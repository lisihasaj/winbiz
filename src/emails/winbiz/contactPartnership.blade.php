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
            'value' => $__data['telephone']
        ],
        (object) [
            'key' => 'emails.type_of_partner',
            'value' => $__data['typeOfPartner']
        ],
        (object) [
            'key' => 'emails.social.reason',
            'value' => $__data['socialReason']
        ],
        (object) [
            'key' => 'emails.ide_number',
            'value' => $__data['ideNumber']
        ],
        (object) [
            'key' => 'emails.website',
            'value' => $__data['website']
        ],
        (object) [
            'key' => 'emails.address',
            'value' => $__data['address']
        ],
        (object) [
            'key' => 'emails.zip_code',
            'value' => $__data['npa']
        ],
        (object) [
            'key' => 'emails.city',
            'value' => $__data['city']
        ],
        (object) [
            'key' => 'emails.company.size',
            'value' => $__data['companySize']
        ],
        (object) [
            'key' => 'emails.type_of_business',
            'value' => $__data['typeOfBusiness']
        ],
        (object) [
            'key' => 'emails.reasons.message',
            'value' => $__data['reasonsMessage']
        ],
        (object) [
            'key' => 'emails.package.type',
            'value' => $__data['packageType']
        ],
        (object) [
            'key' => 'emails.other.package',
            'value' => $__data['otherPackage']
        ],
        (object) [
            'key' => 'emails.solution.type',
            'value' => $__data['solutionType']
        ],
        (object) [
            'key' => 'emails.other.solution',
            'value' => $__data['otherSolution']
        ],
    );
@endphp

<p><strong>{{ __('emails.winbiz.message-from')}} :</strong></p>

@foreach ($fields as $field)
    @if(isset($field->value))
        @include('emails.winbiz.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
    @endif
@endforeach