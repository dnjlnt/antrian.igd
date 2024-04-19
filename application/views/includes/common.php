<?php
	if ($this->uri->segment(1) == "auth") {
		if ($this->uri->segment(2) == "login") {
			$header = "<meta charset='utf-8'>
                       <meta name='viewport' content='width=device-width, initial-scale=1'>
                       <title>AdminLTE 3 | Log in (v2)</title>
                       <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
                       <link rel='stylesheet' href='".base_url()."assets/plugins/fontawesome-free/css/all.min.css'>
                       <link rel='stylesheet' href='".base_url()."assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
                       <link rel='stylesheet' href='".base_url()."assets/dist/css/adminlte.min.css'>";
		} else if ($this->uri->segment(2) == "register") {
			$header = " <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <title>AdminLTE 3 | Registration Page (v2)</title>
                        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
                        <link rel='stylesheet' href='".base_url()."assets/plugins/fontawesome-free/css/all.min.css'>
                        <link rel='stylesheet' href='".base_url()."assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
                        <link rel='stylesheet' href='".base_url()."assets/dist/css/adminlte.min.css'>";
		}
	} else if ($this->uri->segment(1) == "dashboard" || $this->uri->segment(1) == "") {
        $header = " <meta charset='utf-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
                    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
                    <link rel='stylesheet' href='".base_url()."assets/plugins/fontawesome-free/css/all.min.css'>
                    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
                    <link rel='stylesheet' href='".base_url()."assets/dist/css/adminlte.min.css'>
                    <link rel='stylesheet' href='".base_url()."assets/plugins/select2/css/select2.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/bs-stepper/css/bs-stepper.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/jqvmap/jqvmap.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/dist/css/adminlte.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/daterangepicker/daterangepicker.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/summernote/summernote-bs4.min.css'>
                    <style>
                    .carousel-inner img {
                        width: 100%;
                    }
                    </style>";
    } else {
		$header = "<meta charset='utf-8'>
                   <meta name='viewport' content='width=device-width, initial-scale=1'>
                   <title>AdminLTE 3 | Dashboard</title>
                   <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/fontawesome-free/css/all.min.css'>
                   <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/daterangepicker/daterangepicker.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/select2/css/select2.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/bs-stepper/css/bs-stepper.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/jqvmap/jqvmap.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/dist/css/adminlte.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/daterangepicker/daterangepicker.css'>
                   <link rel='stylesheet' href='".base_url()."assets/plugins/summernote/summernote-bs4.min.css'>";
	}
?>

<head>
    <?php echo $header; ?>
</head>