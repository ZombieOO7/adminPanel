@php
$user = Auth::guard('admin')->user();
@endphp
<div class="d-flex align-items-stretch flex-shrink-0">
    <div class="d-flex align-items-stretch flex-shrink-0">
        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <img src="{{asset(@$user->attachment->image_path)}}" alt="user" />
            </div>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{asset(@$user->attachment->image_path)}}" />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-5">{{@$user->name}}
                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span></div>
                            <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{@$user->email}}</a>
                        </div>
                    </div>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a href="{{url('admin/profile')}}" class="menu-link px-5">{{__('label.profile')}}</a>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-side-logout').submit();"  class="menu-link px-5">Sign Out</a>
                    <form id="frm-side-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>