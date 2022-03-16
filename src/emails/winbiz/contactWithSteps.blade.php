<div class="body-text-box">
    <div class="hr"></div>  
    <p class="body-text"> 
        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            {{ __('emails.winbiz.message-from')}} :
        </span>
        <br/>
        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>{{ __('emails.first.last.name')}}:</strong>{{$gender}} {{$first_name}} {{$last_name}}<br/>
        </span>
        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>{{ __('emails.email.address')}}</strong> {{$email}}<br/>
        </span>
        @if(isset($telephone))
            <span style="color:#55575d;font-family:Verdana;font-size:13px;">
                <strong>{{ __('emails.telephone')}}</strong> {{$telephone}}<br/>
            </span>
        @endif

        @if(isset($clientId))
            <span style="color:#55575d;font-family:Verdana;font-size:13px;">
                <strong>Client ID:</strong> {{$clientId}}<br/>
            </span>
        @endif

        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>Nom de l’entreprise:</strong> {{$companyName}}</br>
        </span>

        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>Step 1:</strong> {{$stepOne}}</br>
        </span>

        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>Step 2:</strong> {{$stepTwo}}</br>
        </span>
        <span style="color:#55575d;font-family:Verdana;font-size:13px;">
            <strong>Message :</strong>{{$message}}
        </span>
    </p>
    <div class="hr"></div>  
</div>
