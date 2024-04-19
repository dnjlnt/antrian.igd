<html lang='en'>
	<head>
		<title>IGD Time Stamp</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .wrapper {
                padding:20px 20px 10px 20px;
            }
        </style>
	</head>
		<body>
			<div class="wrapper">
                <div class="card bg-light text-dark" style="padding:15px 20px 10px 10px;">
                    <div class="form-group">
                        <label for="patient_mr">Patient Bed:</label>
                        <input type="hidden" id="time_stamp_id" value="<?php echo $time_stamp_id; ?>">
                    </div>
                    <div class="row" style="text-align:center;">
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedOne()">1</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedTwo()">2</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedThree()">3</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedFour()">4</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedFive()">5</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="width:85px;" onclick="patientBedSix()">6</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-primary" style="margin-top:10px;width:85px;" onclick="patientBedSeven()">7</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="margin-top:10px;width:85px;" onclick="patientBedEight()">8</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="margin-top:10px;width:85px;" onclick="patientBedNine()">9</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" style="margin-top:10px;width:85px;" onclick="patientBedTen()">10</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-warning" style="margin-top:10px;width:135px;" onclick="patientBedResusitasi()">Resusitasi</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-warning" style="margin-top:10px;width:135px;" onclick="patientBedTindakan()">Tindakan</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-warning" style="margin-top:10px;width:135px;" onclick="patientBedPonek()">Ponek</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-warning" style="margin-top:10px;width:120px;" onclick="patientBedIsolasi()">Isolasi</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-danger" style="margin-top:10px;width:135px;" onclick="removePatientBed()">Hilangkan Bed</button>
                        </div>
                    </div>
			    </div>
			</div>
		</body>
        <script>
            setTimeout("window.close()", 600000); 
            
            function patientBedOne() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "1";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedone',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedTwo() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "2";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedtwo',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedThree() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "3";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedthree',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedFour() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "4";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedfour',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedFive() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "5";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedfive',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedSix() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "6";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedsix',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedSeven() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "7";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedseven',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedEight() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "8";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedeight',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedNine() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "9";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbednine',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedTen() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "10";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedten',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedResusitasi() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "resusitasi";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedresusitasi',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedTindakan() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "tindakan";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedtindakan',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedPonek() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "ponek";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedponek',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function patientBedIsolasi() {
                var time_stamp_id = $('#time_stamp_id').val();
                var patient_bed = "isolasi"
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientbedisolasi',
                    data: {time_stamp_id:time_stamp_id, patient_bed:patient_bed},
                    success: function (data) {
                        if (data == "bednotempty") {
                            alert("Masih ada pasien di bed tersebut");
                            return;
                        } else if (data == "successsavepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal merubah bed");
                            return;
                        }
                    }
                });
            }

            function removePatientBed() {
                var time_stamp_id = $('#time_stamp_id').val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/removepatientbed',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "successremovepatientbed") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal menghapus bed");
                            return;
                        }
                    }
                });
            }
        </script>
	</html>

