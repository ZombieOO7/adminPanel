@extends('admin.admin.common.app')
@section('content')
@section('title',__('label.reset_password'))
@php
	$setting = settings();
@endphp
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="{{route('admin.login')}}" class="mb-12">
            <img alt="Logo" src="{{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}}" class="h-40px" />
        </a>
        <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            {{ Form::open(['class'=>'form w-100','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                <input type="hidden" name="token" value="{{ @$token }}">
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">{{__('label.reset_password')}}</h1>
                    <div class="text-gray-400 fw-bold fs-4">{{__('label.already_account')}}
                    <a href="{{route('admin.login')}}" class="link-primary fw-bolder">{{__('label.sign_in')}}</a></div>
                </div>
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <div class="mb-1">
                        {!! Form::label(null,__('label.password'), ['class'=>'form-label fw-bolder text-dark fs-6']) !!}
                        <div class="position-relative mb-3">
                            {!! Form::password('password', ['class' => 'form-control form-control-lg form-control-solid', 'placeholder'=>__('label.password'), 'autocomplete'=>'off','id'=>'password', 'minlength'=>@config('validation.password_min_length'), 'maxlength'=>@config('validation.password_max_length') ]) !!}
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                    </div>
                    <div class="text-muted">{{__('label.password_note')}}</div>
                </div>
                <div class="fv-row mb-10">
                    {!! Form::label(null,__('label.confirm_password'),['class'=>'form-label fw-bolder text-dark fs-6']) !!}
                    {!! Form::password('confirm_password', ['class' => 'form-control form-control-lg form-control-solid', 'placeholder'=>__('label.confirm_password'), 'autocomplete'=>'off' ]) !!}
                </div>
                <div class="text-center">
                    <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                        <span class="indicator-label">{{__('label.submit')}}</span>
                        <span class="indicator-progress">{{__('label.wait')}}
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
<script>
    var forgotPasswordUrl = "{{route('admin.reset.password')}}";
</script>
<script src="{{asset('backend/js/admin/reset-password.js')}}"></script>
@endsection