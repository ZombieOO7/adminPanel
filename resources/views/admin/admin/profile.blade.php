@extends('admin.layouts.app')
@section('title',@$title)
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{@$admin->attachment->image_path}}" alt="image" />
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{@$admin->name}}</a>
                                        <a href="#">
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                    <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                            </svg>
                                        </span>
                                        {{@$admin->getRoleNames()->first()}}</a>
                                        <a href="mailto:{{@$admin->email}}" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                            </svg>
                                        </span>
                                        {{@$admin->email}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder" role="tablist">
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_profile_details_view">Overview</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_profile_edit_view">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="card mb-5 mb-xl-10 active tab-pane" id='kt_profile_details_view'>
                    <div class="card-header cursor-pointer" id="kt_profile_details_view" role="tabpanel">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{__('label.profile_detail')}}</h3>
                        </div>
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{__('label.name')}}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{@$admin->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{__('label.contact_no')}}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">044 3276 454 935</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{__('label.company_site')}}</label>
                            <div class="col-lg-8">
                                <a href="{{route('home')}}" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{env('APP_URL')??config('app.url')}}</a>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{__('label.email')}}</label>
                            <div class="col-lg-8">
                                <a href="mailto::{{@$admin->email}}" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{@$admin->email}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="kt_profile_edit_view" class="card mb-5 mb-xl-10 tab-pane">
                    @if(isset($admin) || !empty($admin))
                    {{ Form::model($admin, ['route' => ['admin.profile.store', @$admin->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
                    @else
                    {{ Form::open(['route' => 'admin.profile.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
                    @endif
                        <div class="card-header cursor-pointer" id="kt_profile_details_view" role="tabpanel">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">{{__('label.profile_detail')}}</h3>
                            </div>
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{__('label.profile_pic')}}</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('backend/images/blank.png')}})">
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{@$admin->attachment->image_path ?? asset('backend/media/logos/logo-1.svg')}}">
                                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{@$admin->attachment->image_path}})"></div>
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
                                {!! Form::label(null,__('label.name'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 fv-row">
                                            {!! Form::text('name', @$admin->name, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.name'), 'maxlength' => @config('validation.input_max_length') ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                {!! Form::label(null,__('label.email'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 fv-row">
                                            {!! Form::text('email', @$admin->email, ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'id'=>'problem_id', 'placeholder'=>__('label.email'), 'maxlength' => @config('validation.input_max_length')]) !!}
                                        </div>
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
                            <div class="row mb-6">
                                {!! Form::label(null,__('label.confirm_password'),['class'=>'col-lg-4 col-form-label required fw-bold fs-6']) !!}
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 fv-row">
                                            {!! Form::password('confirm_password', ['class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'placeholder'=>__('label.confirm_password'), 'autocomplete'=>'off' ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
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
    </div>
@stop
@section('admin_script')
    <script src="{{asset('backend/js/admin/profile.js')}}"></script>
@endsection