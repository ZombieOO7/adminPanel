@include('emails.include.head')
@include('emails.include.header')
<h2 style=" background-color: #00c0ef;    color: #fff;">Contact Us</h2>
<div class="content">
    {!! @$content !!}
</div>
@include('emails.include.footer')
