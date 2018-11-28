@if($emailTemplate != '')
    {!! $emailTemplate !!}  
@endif

<div style="Margin-left: 20px;Margin-right: 20px;Margin-top: 10px;Margin-bottom: 10px;text-align: center">
@if($url != '' && $emailId != '')
    <a target="_blank" style="text-decoration: underline;transition: opacity 0.1s ease-in;color: #a3a4ad;"
       href="{{ $url .'/' . Crypt::encrypt($emailId) }}">Unsubscribe</a>
@endif
</div>