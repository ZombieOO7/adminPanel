@include('emails.include.head')
@include('emails.include.header')

<h2 style=" background-color: #00c0ef;    color: #fff;">Reset Password</h2>
<div class="content">
    <a style="color: #00c0ef !important; padding: 0; font-size: 2rem; letter-spacing: 1.2rem; border-right: 0;" href="{{route('admin.verify.mail',['token' => $token])}}">Click Here</a>
    <p>If you did request for password reset, no further action is required.</p>
</div>
@include('emails.include.footer')
