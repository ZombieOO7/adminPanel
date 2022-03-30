@include('emails.include.head')
@include('emails.include.header')

<h2 style=" background-color: #00c0ef;    color: #fff;">Verify Your Account</h2>
<div class="content">
    <p>Please click on below link to verify your account.</p>
    <div class="action" style="width: 100%; clear: both;">
        <a style="color: #00c0ef !important; padding: 0; font-size: 2rem; letter-spacing: 1.2rem; border-right: 0;" href="{{route('front.verify.mail',['email' => $email])}}">Click Here</a>
        {{-- <h2 style="color: #fff !important; padding: 0; font-size: 2rem; letter-spacing: 1.2rem; border-right: 0;" class="button button-primary">Click Here</h2> --}}
    </div>
    <p>If you did not create an account, no further action is required.</p>
</div>
@include('emails.include.footer')
