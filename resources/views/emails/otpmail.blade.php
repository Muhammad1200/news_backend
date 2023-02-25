@component('mail::message')
    Hi {{ $name }}
    <br/>
    Here is your otp code : {{ $otp }}

    {{--@component('mail::button', ['url' => ''])--}}
    {{--Button Text--}}
    {{--@endcomponent--}}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
