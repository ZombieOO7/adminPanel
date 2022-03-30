<script src="{{asset('backend/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('backend/js/scripts.bundle.js')}}"></script>
<script>
    var hostUrl = "{{URL::to('/')}}";
    var base_url = "{{URL::to('/')}}";
    var rule = $.extend({}, {!!json_encode(config('validation'), JSON_FORCE_OBJECT) !!});
    var token = "{{csrf_token()}}";
</script>
<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('backend/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
<script src="{{asset('backend/js/common.js')}}"></script>
@yield('admin_script')