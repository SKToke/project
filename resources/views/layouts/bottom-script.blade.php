<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
</script>
@if(session('warning'))
    <script>
        $( document ).ready(function () {
            toastr.warning("{{ session('warning') }}", "Warning!");
        });
    </script>
@endif

