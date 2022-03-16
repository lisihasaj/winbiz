@include('emails.client.common.header')
                        <!--EMAIL BODY-->

                        <div style="background-color:transparent;">
                            <div class="block-grid" style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
                            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:680px"><tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="680" style="background-color:#ffffff;width:680px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">
                            <div class="col_cont" style="width:100% !important;">
                            <!--[if (!mso)&(!IE)]><!-->
                            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                            <!--<![endif]-->

                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 25px; padding-left: 25px; padding-top: 0px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                            <div style="color:#555555;font-family:Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:25px;padding-bottom:10px;padding-left:25px;">
                                <div class="txtTinyMce-wrapper" style="font-size: 16px; line-height: 1.2; color: #555555; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 17px;">
                                    <p style="margin: 0; line-height: 1.2; word-break: break-word; font-size: 16px; mso-line-height-alt: 19px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px; color: #555555;">{!! __('emails.trainings.user.confirmation', ['first_name' => $first_name, 'training_name' => $training_name]) !!} </span></p>
                                </div>
                            </div>
                            <!--[if mso]></td></tr></table><![endif]-->

                            <!--[if (!mso)&(!IE)]><!-->
                                @if(isset($dates))
                                    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 25px; padding-left: 25px; padding-top: 5px; padding-bottom: 5px; font-family: Arial, sans-serif"><![endif]-->
                                    <div style="color:#555555;font-family:Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:25px;padding-bottom:5px;padding-left:25px;">
                                        <div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.2; color: #555555; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 17px;">
                                            <p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word; mso-line-height-alt: 17px; margin-top: 0; margin-bottom: 0;"><strong>{{__('emails.schedule')}}</strong></p>
                                            <br>
                                        </div>
                                    </div>
                                    @foreach($dates as $key => $date)
                                        <div style="color:#555555;font-family:Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:25px;padding-bottom:5px;padding-left:25px;">
                                            <div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.2; color: #555555; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 17px;">
                                                <p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word; mso-line-height-alt: 17px; margin-top: 0; margin-bottom: 0;"><strong>{{$key}}:</strong> {!! $date !!}</p>
                                                <br>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        @endforeach
                                    <!--[if mso]></td></tr></table><![endif]-->
                                @endif
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
