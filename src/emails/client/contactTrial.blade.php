@include('emails.client.common.header')

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

                            @include('emails.client.common.paragraph', ['text' => __('emails.client.trial.intro', ['first_name' => $first_name]) ])
                            <br />
                            @include('emails.client.common.paragraphKeyValue', ['key' => 'emails.download', 'value' => 'http://download.winbiz.ch/wb9/wb9_eval_web_install.msi'])
                            @include('emails.client.common.paragraphKeyValue', ['key' => 'emails.password', 'value' => 'SKOLL418'])
                            <br />
                            @include('emails.client.common.paragraph', ['text' => __('emails.client.trial.assistance') ])

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
