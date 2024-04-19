<?php
    if ($this->uri->segment(1) == "auth") {
        if ($this->uri->segment(2) == "login") {
            echo "<script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
                  <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
                  <script src='".base_url()."assets/plugins/jquery/jquery.min.js'></script>
                  <script src='".base_url()."assets/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
                  <script src='".base_url()."assets/dist/js/adminlte.min.js'></script>";
        } else if ($this->uri->segment(2) == "register") {
            echo "<script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
                  <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
                  <script src='".base_url()."assets/plugins/jquery/jquery.min.js'></script>
                  <script src='".base_url()."assets/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
                  <script src='".base_url()."assets/dist/js/adminlte.min.js'></script>";
        }
    } else if ($this->uri->segment(1) == "dashboard" || $this->uri->segment(1) == "") {
        echo "<script src='".base_url()."assets/plugins/jquery/jquery.min.js'></script>
              <script src='".base_url()."assets/plugins/jquery-ui/jquery-ui.min.js'></script>
              <script>
                $.widget.bridge('uibutton', $.ui.button)
              </script>
              <script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
              <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
              <script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js'></script>
              <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
              <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js'></script>
              <script src='".base_url()."assets/dist/js/adminlte.js'></script>
              <script src='".base_url()."assets/dist/js/demo.js'></script>";
    } else {
        echo "<script src='".base_url()."assets/plugins/jquery/jquery.min.js'></script>
              <script src='".base_url()."assets/plugins/jquery-ui/jquery-ui.min.js'></script>
              <script>
                $.widget.bridge('uibutton', $.ui.button)
              </script>
              <script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
              <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
              <script src='".base_url()."assets/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
              <script src='".base_url()."assets/plugins/chart.js/Chart.min.js'></script>
              <script src='".base_url()."assets/plugins/sparklines/sparkline.js'></script>
              <script src='".base_url()."assets/plugins/jqvmap/jquery.vmap.min.js'></script>
              <script src='".base_url()."assets/plugins/jqvmap/maps/jquery.vmap.usa.js'></script>
              <script src='".base_url()."assets/plugins/jquery-knob/jquery.knob.min.js'></script>
              <script src='".base_url()."assets/plugins/moment/moment.min.js'></script>
              <script src='".base_url()."assets/plugins/daterangepicker/daterangepicker.js'></script>
              <script src='".base_url()."assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'></script>
              <script src='".base_url()."assets/plugins/summernote/summernote-bs4.min.js'></script>
              <script src='".base_url()."assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'></script>
              <script src='".base_url()."assets/dist/js/adminlte.js'></script>
              <script src='".base_url()."assets/dist/js/demo.js'></script>
              <script src='".base_url()."assets/dist/js/pages/dashboard.js'></script>
              <script src='".base_url()."assets/plugins/select2/js/select2.full.min.js'></script>
              <script src='".base_url()."assets/plugins/daterangepicker/daterangepicker.js'></script>
              <script src='".base_url()."assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'></script>
              <script src='".base_url()."assets/plugins/bs-stepper/js/bs-stepper.min.js'></script>
              <script>
                $(function () {
                    $('.select2').select2()
            
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
            
                    $('#meetingdate').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
            
                    $('#timepicker').datetimepicker({
                        pickDate: false,
                        minuteStepping:30,
                        format: 'HH:mm',
                        pickTime: true,
                        language:'en',
                        use24hours: true
                    })
            
                    $('#timepicker2').datetimepicker({
                        pickDate: false,
                        minuteStepping:30,
                        format: 'HH:mm',
                        pickTime: true,
                        language:'en',
                        use24hours: true
                    })
                })
            
                document.addEventListener('DOMContentLoaded', function () {
                    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                })
              </script>";
    }
?>

