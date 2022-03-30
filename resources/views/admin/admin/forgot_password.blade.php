@extends('admin.admin.common.app')
@section('title',__('label.forgot_password'))
@section('content')
@php
	$setting = settings();
@endphp
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{asset('backend/media/illustrations/sketchy-1/14.png')}}">
	<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
		<a href="{{route('admin.dashboard')}}" class="mb-12">
			<img alt="Logo" src="{{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}}" class="h-40px" />
		</a>
		<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
			{{ Form::open(['class'=>'form w-100','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
				<div class="text-center mb-10">
					<h1 class="text-dark mb-3">{{__('label.forgot_password')}}</h1>
					<div class="text-gray-400 fw-bold fs-4">{{__('label.reset_note')}}</div>
				</div>
				<div class="fv-row mb-10">
					<label class="form-label fs-6 fw-bolder text-dark">{{__('label.email')}}</label>
					<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
				</div>
				<div class="d-flex flex-wrap justify-content-center pb-lg-0">
					<button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
						<span class="indicator-label">{{__('label.submit')}}</span>
						<span class="indicator-progress">{{__('label.wait')}}
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
					<a href="{{route('admin.login')}}" class="btn btn-lg btn-light-primary fw-bolder">{{__('label.cancel')}}</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection
@section('scripts')
<script>
	var forgotPasswordUrl = "{{route('admin.sent.reset-link')}}";
</script>
<script src="{{asset('backend/js/admin/forgot-password.js')}}"></script>
@endsection