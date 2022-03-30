@extends('admin.admin.common.app')
@section('content')
@section('title',__('label.login'))
<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
	<a href="{{route('admin.dashboard')}}" class="mb-12">
		<img alt="Logo" src="{{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}}" class="h-40px" />
	</a>
	<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
		{{ Form::open(['class'=>'form w-100','id'=>'sign_in_form','files' => true,'autocomplete' => "off"]) }}
			<div class="text-center mb-10">
				<h1 class="text-dark mb-3">Sign In to {{@$setting->title ?? env('APP_NAME')}}</h1>
			</div>
			<div class="fv-row mb-10">
				<label class="form-label fs-6 fw-bolder text-dark">{{__('label.email')}}</label>
				<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
			</div>
			<div class="fv-row mb-10">
				<div class="d-flex flex-stack mb-2">
					<label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('label.password')}}</label>
					<a href="{{ route('admin.reset-password') }}" class="link-primary fs-6 fw-bolder">{{__('label.forgot_password')}} ?</a>
				</div>
				<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
			</div>
			<div class="text-center">
				<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
					<span class="indicator-label">{{__('label.submit')}}</span>
					<span class="indicator-progress">{{__('label.wait')}}
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
				</button>
				<!--end::Submit button-->
				<!--begin::Separator-->
				{{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
				<!--end::Separator-->
				<!--begin::Google link-->
				<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
				<img alt="Logo" src="{{asset('backend/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3" />Continue with Google</a>
				<!--end::Google link-->
				<!--begin::Google link-->
				<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
				<img alt="Logo" src="{{asset('backend/media/svg/brand-logos/facebook-4.svg')}}" class="h-20px me-3" />Continue with Facebook</a>
				<!--end::Google link-->
				<!--begin::Google link-->
				<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
				<img alt="Logo" src="{{asset('backend/media/svg/brand-logos/apple-black.svg')}}" class="h-20px me-3" />Continue with Apple</a> --}}
				<!--end::Google link-->
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection
@section('scripts')
<script>
	var loginUrl = "{{route('admin.login.post')}}";
</script>
<script src="{{asset('backend/js/admin/login.js')}}"></script>
@endsection
