@extends('admin.layouts.app')
@section('title',@$title)
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10">
            @if(isset($user) || !empty($user))
            {{ Form::model($user, ['route' => ['admin.user.store', @$user->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
            @else
            {{ Form::open(['route' => 'admin.user.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
            @endif
            <div class="card-body p-9">
                @include('admin.includes.messages')
                {!! Form::hidden('id', @$user->id, []) !!}
                <div class="row mb-6">
                    {!! Form::label(null,__('label.name'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::text('name', @$user->name, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.name'), 'maxlength' => @config('validation.input_max_length') ]) !!}
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.email'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::email('email', @$user->email, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.email'), 'maxlength' => @config('validation.input_max_length') ]) !!}
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-6" data-kt-password-meter="true">
                    {!! Form::label(null,__('label.password'), ['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                <div class="position-relative mb-3">
                                    {!! Form::password('password', ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'placeholder'=>__('label.password'), 'autocomplete'=>'off','id'=>'password', 'minlength'=>@config('validation.password_min_length'), 'maxlength'=>@config('validation.password_max_length') ]) !!}
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <div class="text-muted">{{__('label.password_note')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.confirm_password'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::password('confirm_password', ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'placeholder'=>__('label.confirm_password'), 'autocomplete'=>'off' ]) !!}
                            </div>
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.status'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name='status' value="1" checked="checked">
                                </label>
                            </div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-start py-6 px-9">
                <button type="submit" class="btn btn-primary  me-2">
                    <span class="indicator-label">{{__('label.save')}}</span>
                    <span class="indicator-progress">{{__('label.wait')}}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <a role="button" class="btn btn-light btn-active-light-primary" href="{{route('admin.user.index')}}">{{__('label.cancel')}}</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('admin_script')
<script src="{{asset('backend/js/user/create.js')}}"></script>
@endsection