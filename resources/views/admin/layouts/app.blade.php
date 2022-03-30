@php
$setting = settings();
@endphp
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
    <head>
        <base href="{{URL::to('/')}}">
        <title>{{@$title}} | {{@$setting->title ?? env('APP_NAME')}}</title>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{@$setting->title ?? env('APP_NAME')}}" />
        <meta property="og:url" content="{{env('APP_URL')}}" />
        <meta property="og:site_name" content="{{@$setting->title ?? env('APP_NAME')}}" />
        @include('admin.includes.headerCss')
        @yield('admin_css')
    </head>
	<!--end::Head-->
    <!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
        <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
                @include('admin.includes.sidebar')
                <!--end::Aside-->
                <!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
                        @include('admin.includes.header')
					<!--end::Header-->
                        <!--begin::Content-->
                        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                            @include('admin.includes.toolbar')
                            @yield('content')
                            <!--end::Content-->
                        </div>
                        <!--begin::Footer-->
                        @include('admin.includes.footer')
                        <!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
        <!--end::Root-->
        <!--begin::Drawers-->
        @include('admin.includes.footerScript')
	</body>
	<!--end::Body-->
</html>