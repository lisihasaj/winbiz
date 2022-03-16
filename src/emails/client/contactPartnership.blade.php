@include('emails.client.common.header')
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
                        <!--EMAIL BODY-->

                        <!--EMAIL BODY INPUT CONTENT-->

						<div style="background-color:transparent;">
                            <div class="block-grid" style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
                            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:680px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="680" style="background-color:#ffffff;width:680px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:30px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">
                            <div class="col_cont" style="width:100% !important;">
                            <!--[if (!mso)&(!IE)]><!-->
                            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:30px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;">
                            <!--<![endif]-->

                            @include('emails.client.common.paragraph', ['text' => __('emails.client.partnership.intro', ['first_name' => $first_name]) ])
                            @include('emails.client.common.paragraph', ['text' => __('emails.client.data-recap') ])

                            @foreach ($fields as $field)
                                @if(isset($field->value))
                                    @include('emails.client.common.paragraphKeyValue', ['key' => $field->key, 'value' => $field->value])
                                @endif
                            @endforeach

                            <br>
                            <!--[if (!mso)&(!IE)]><!-->
                            </div>
                            <!--<![endif]-->
                            </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                            </div>
                            </div>
						</div>
						
@include('emails.client.common.closingSentence')
@include('emails.client.common.footer')

