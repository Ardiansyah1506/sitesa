<!--   Core JS Files   -->
<script src="{{ url('') }}/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="{{ url('') }}/assets/js/core/popper.min.js"></script>
<script src="{{ url('') }}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ url('') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="{{ url('') }}/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{ url('') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{ url('') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{ url('') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{ url('') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="{{ url('') }}/assets/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="{{ url('') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="{{ url('') }}/assets/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ url('') }}/assets/js/setting-demo.js"></script>
<script src="{{ url('') }}/assets/js/demo.js"></script>
<script>
  $(document).ready(function() {
            @if (session('success'))
              swal({
                text: '{{ session("success") }}',
                icon: "success",
                buttons: {
                  confirm: {
                    text: "Confirm Me",
                    value: true,
                    visible: true,
                    className: "btn btn-success",
                    closeModal: true,
                  },
                },
              });
            @elseif (session()->has('error'))
            swal({
                text: '{{ session("error") }}',
                icon: "error",
                buttons: {
                  confirm: {
                    text: "Confirm Me",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                  },
                },
              });
            @endif
        });
</script>