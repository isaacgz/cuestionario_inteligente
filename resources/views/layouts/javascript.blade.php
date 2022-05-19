<!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script type="text/javascript">const global_url = hostUrl = "{{ url('') }}";</script>
    <script type="text/javascript">const global_data = "{{ url('/') }}";</script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dar_mode.js') }}"></script>
    <script src="{{ asset('assets/js/res_status.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.sweetalerts.js')}}"></script>
    <!--end::Global Javascript Bundle-->
<!--end::Javascript-->