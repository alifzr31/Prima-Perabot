<script src="{{ asset('assets/admin/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/scripts/dashboard.js') }}"></script>
<script src="{{ url('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>

<script>
    //message with toastr
    @if (session()->has('success'))
        toastr.success('{{ session('success') }}', 'Berhasil');
    @elseif (session()->has('error'))
        toastr.error('{{ session('error') }}', 'Gagal');
    @endif
</script>
@yield('custom-scripts')
