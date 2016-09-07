<script>

    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "positionClass": "toast-top-center",
      "showDuration": "3000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
</script>

@if ($errors->count() > 0)

    @foreach ($errors->all() as $error)

        <script>
            toastr.options.positionClass = 'toast-top-right'
            toastr["error"]("{{ $error }}")
        </script>

    @endforeach

@endif

@if (session('success'))

    <script>
        toastr["success"]("{{ session('success') }}")
    </script>

@endif

@if (session('error'))

    <script>
        toastr["error"]("{{ session('error') }}")
    </script>

@endif

@if (session('warning'))

    <script>
        toastr["warning"]("{{ session('warning') }}")
    </script>

@endif

