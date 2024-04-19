<html lang='en'>
	<head>
		<title>IGD Time Stamp</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" href="<?php echo base_url();?>assets/keypad.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/keypad.js"></script>
        <style>
            #nav-bar { visibility: collapse !important; }
            .wrapper {
                padding:20px 20px 10px 20px;
            }
        </style>
	</head>
		<body>
			<div class="wrapper">
                <div class="card bg-light text-dark" style="padding:15px 20px 10px 20px;">
                    <div class="row">
                        <div class="col-sm-12" align="center">
                            <h5>Pilihan Pasien Pulang</h5>
                        </div>
                    </div>
                    <input type="hidden" id="time_stamp_id" name="time_stamp_id" value="<?php echo $_GET["id"]; ?>">
                    <div class="row">
                        <div class="col-sm-12" style="margin-top:20px;">
                            <button type="submit" onclick="instruksiDokter()" class="btn btn-block btn-secondary" style="height:70px;">Pasien Pulang Atas Instruksi Dokter</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top:10px;">
                            <button type="submit" onclick="permintaanSendiri()" class="btn btn-block btn-secondary" style="height:70px;">Pasien Pulang Atas Permintaan Sendiri</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top:10px;">
                            <button type="submit" onclick="meninggalDunia()" class="btn btn-block btn-secondary" style="height:70px;">Pasien Meninggal Dunia</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top:10px;">
                            <button type="submit" onclick="pasienDirujuk()" class="btn btn-block btn-secondary" style="height:70px;">Pasien Dirujuk</button>
                        </div>
                    </div>
			    </div>
                <br>
			</div>
		</body>
        <script>
            function instruksiDokter() {
                var r = confirm("Apakah pasien ini pulang atas intruksi dokter?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/instruksidokter',
                        data: {time_stamp_id:time_stamp_id},
                        success: function (data) {
                            data = JSON.parse(data);

                            if (data.status == "success") {
                                alert(data.message);
                                window.opener.location.reload(true);
                                window.close(); 
                            } else {
                                alert(data.message);
                                return;
                            }
                        }
                    });    
                } else {
                    return false;
                }
            }

            function permintaanSendiri() {
                var r = confirm("Apakah pasien ini pulang atas permintaan sendiri?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/permintaansendiri',
                        data: {time_stamp_id:time_stamp_id},
                        success: function (data) {
                            data = JSON.parse(data);

                            if (data.status == "success") {
                                alert(data.message);
                                window.opener.location.reload(true);
                                window.close(); 
                            } else {
                                alert(data.message);
                                return;
                            }
                        }
                    });    
                } else {
                    return false;
                }
            }

            function meninggalDunia() {
                var r = confirm("Apakah pasien ini pulang karena meninggal dunia?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/meninggaldunia',
                        data: {time_stamp_id:time_stamp_id},
                        success: function (data) {
                            data = JSON.parse(data);

                            if (data.status == "success") {
                                alert(data.message);
                                window.opener.location.reload(true);
                                window.close(); 
                            } else {
                                alert(data.message);
                                return;
                            }
                        }
                    });    
                } else {
                    return false;
                }
            }

            function pasienDirujuk() {
                var r = confirm("Apakah pasien ini pulang karena dirujuk?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/pasiendirujuk',
                        data: {time_stamp_id:time_stamp_id},
                        success: function (data) {
                            data = JSON.parse(data);

                            if (data.status == "success") {
                                alert(data.message);
                                window.opener.location.reload(true);
                                window.close(); 
                            } else {
                                alert(data.message);
                                return;
                            }
                        }
                    });    
                } else {
                    return false;
                }
            }
        </script>
	</html>

