@extends('admin.layouts.app')
@section('title',@$title)
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10">
            @if(isset($setting) || !empty($setting))
            {{ Form::model($setting, ['route' => ['admin.setting.store', @$setting->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
            @else
            {{ Form::open(['route' => 'admin.setting.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
            @endif
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">{{__('label.update')}} {{@$title}}</h3>
                </div>
            </div>
            <div class="card-body p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{__('label.logo')}}</label>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}})">
                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}}">
                                <div class="image-input-wrapper w-300px h-200px" style="background-image: url({{@$setting->attachment->logo_path ?? asset('backend/media/logos/logo-1.svg')}})"></div>
                            </a>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="form-text">{{__('label.img_upload_note')}}</div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.title'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::text('title', @$setting->title, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.name'), 'maxlength' => @config('validation.input_max_length') ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.email'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::text('email', @$setting->email, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.email'), 'maxlength' => @config('validation.input_max_length') ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    {!! Form::label(null,__('label.copy_right'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row">
                                {!! Form::text('copyright', @$setting->copyright, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.copy_right'), 'maxlength' => @config('validation.input_max_length')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{__('label.update')}}</span>
                    <span class="indicator-progress">{{__('label.wait')}}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('admin_script')
<script src="{{asset('backend/js/setting/index.js')}}"></script>
@endsection