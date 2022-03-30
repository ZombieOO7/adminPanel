    </div>
</div>
<script src="{{asset('backend/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('backend/js/scripts.bundle.js')}}"></script>
<script>
    var hostUrl = "{{asset('backend')}}";
    var rule = $.extend({}, {!!json_encode(config('validation'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.min.js')}}"></script>
<script src="{{asset('backend/js/common.js')}}"></script>
@yield('scripts')
</body>
</html>