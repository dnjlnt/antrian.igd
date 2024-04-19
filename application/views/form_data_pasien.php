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

            .loading {
                position: fixed;
                z-index: 999;
                height: 2em;
                width: 2em;
                overflow: show;
                margin: auto;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                display:none;
            }

            .loading:before {
                content: '';
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

                background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
            }

            .loading:not(:required) {
                /* hide "loading..." text */
                font: 0/0 a;
                color: transparent;
                text-shadow: none;
                background-color: transparent;
                border: 0;
            }

            .loading:not(:required):after {
                content: '';
                display: block;
                font-size: 10px;
                width: 1em;
                height: 1em;
                margin-top: -0.5em;
                -webkit-animation: spinner 150ms infinite linear;
                -moz-animation: spinner 150ms infinite linear;
                -ms-animation: spinner 150ms infinite linear;
                -o-animation: spinner 150ms infinite linear;
                animation: spinner 150ms infinite linear;
                border-radius: 0.5em;
                -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
                box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
            }

            @-webkit-keyframes spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @-moz-keyframes spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @-o-keyframes spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
        </style>
        <script type="text/javascript">
            $(function(){
                $("#play").click(function(){
                    document.getElementById('suarabel').play();
                    document.getElementById('suarabelnomorurut').play();
                    document.getElementById('suarabelsuarabelloket').play();
                });

                $("#pause").click(function(){
                    document.getElementById("suarabel").pause();
                });

                $("#stop").click(function(){
                    document.getElementById("suarabel").pause();
                    document.getElementById("suarabel").currentTime=0;
                });
            })
        </script>
	</head>
		<body>
			<div class="wrapper">
                <div class="card bg-light text-dark" style="padding:15px 20px 10px 20px;">
                    <div class="form-group">
                        <label for="patient_mr">Patient Medical Record Number:</label>
                        <input type="text" class="form-control" id="patient_mr">
                        <input type="hidden" class="form-control" id="time_stamp_id" value="<?php echo $time_stamp_id; ?>">
                    </div>
                    <div class="keypadContainer">

                    </div>
                    <audio id="suarabel" src="<?php echo base_url();?>assets/audio/tingtong2.wav"></audio> 
                    <audio id="suarabelnomorurut" src="<?php echo base_url();?>assets/audio/antrian/antrian.wav"></audio> 
                    <audio id="diloket" src="<?php echo base_url();?>assets/audio/antrian/loket.wav"></audio> 
                    <?php 
                        if ($kode_warna == "H") {
                            echo "<audio id='kode_warna' src='".base_url()."assets/audio/antrian/Hijau.mp3'></audio>";
                        } else if ($kode_warna == "K") {
                            echo "<audio id='kode_warna' src='".base_url()."assets/audio/antrian/Kuning.mp3'></audio>";
                        } else {
                            echo "<audio id='kode_warna' src='".base_url()."assets/audio/antrian/Merah.mp3'></audio>";
                        }
                        
                        
                        if ($antrian > 11 && $antrian < 20) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, -1, 1).".wav'></audio>";
                        } else if ($antrian == 20) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";
                        } else if ($antrian > 20 && $antrian < 100) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";

                            $a = substr($antrian, -1, 1);
                            if ($a == 0) {

                            } else {
                                echo "<audio id='antrian1' src='".base_url()."assets/audio/antrian/".$a.".wav'></audio>";
                            }
                        } else if ($antrian > 100 && $antrian < 110) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, -1, 1).".wav'></audio>";
                        } else if ($antrian > 111 && $antrian < 120) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, -1, 1).".wav'></audio>";
                        } else if ($antrian > 119 && $antrian < 210) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";

                            $a = substr($antrian, -1, 1);
                            if ($a == 0) {

                            } else {
                                echo "<audio id='antrian1' src='".base_url()."assets/audio/antrian/".$a.".wav'></audio>";
                            }
                        } else if ($antrian == 210) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";
                        } else if ($antrian == 211) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";
                        } else if ($antrian > 211 && $antrian < 220) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";
                            echo "<audio id='antrian1' src='".base_url()."assets/audio/antrian/".substr($antrian, -1, 1).".wav'></audio>";
                        } else if ($antrian > 219 && $antrian < 1000) {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".substr($antrian, 0, 1).".wav'></audio>";

                            $a = substr($antrian, 1,1);
                            $b = substr($antrian, -1,1);

                            echo "<audio id='antrian1' src='".base_url()."assets/audio/antrian/".$a.".wav'></audio>";
                            echo "<audio id='antrian2' src='".base_url()."assets/audio/antrian/".$b.".wav'></audio>";
                        } else {
                            echo "<audio id='antrian' src='".base_url()."assets/audio/antrian/".$antrian.".wav'></audio>";
                        }
                    ?>
                    <audio id="sepuluh" src="<?php echo base_url();?>assets/audio/antrian/sepuluh.wav"></audio>
                    <audio id="sebelas" src="<?php echo base_url();?>assets/audio/antrian/sebelas.wav"></audio>
                    <audio id="seratus" src="<?php echo base_url();?>assets/audio/antrian/seratus.wav"></audio>
                    <audio id="belas" src="<?php echo base_url();?>assets/audio/antrian/belas.wav"></audio>
                    <audio id="puluh" src="<?php echo base_url();?>assets/audio/antrian/puluh.wav"></audio>
                    <audio id="ratus" src="<?php echo base_url();?>assets/audio/antrian/ratus.wav"></audio>
                    <div class="row">
                        <div class="col-sm-12"><button type="submit" onclick="checkDataPatient()" class="btn btn-block btn-info" style="height:70px;">Cek Pasien</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-sm-12"><button type="submit" onclick="editDataPatient()" class="btn btn-block btn-secondary" style="height:70px;">Edit Data Pasien</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-sm-6"><?php echo $btnPanggilAntrian; ?></div>
                        <div class="col-sm-6"><?php echo $btnPasienMasuk; ?></div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-sm-4"><?php echo $btnBatalBerobat; ?></div>
                        <div class="col-sm-4"><?php echo $btnFKTP; ?></div>
                        <div class="col-sm-4"><?php echo $btnBerobatPoli; ?></div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-sm-12"><?php echo $btnDelete; ?></div>
                    </div>
			    </div>
                <br>
                <div id="data-patient-result"></div>
			</div>
        <div class="loading">Loading&#8230;</div>
		</body>
        <script>
            setTimeout("window.close()", 600000); 

            function checkDataPatient() {
                var patient_mr = $("#patient_mr").val();
                var time_stamp_id = $("#time_stamp_id").val();

                if (patient_mr == "") {
                    alert("Masukan Nomor Rekam Medis Pasien!");
                    return;
                }
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/checkdatapatient',
                    data: {patient_mr:patient_mr, time_stamp_id:time_stamp_id},
                    beforeSend: function(){
                        $("#loading").show();
                    },
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function (data) {
                        $("#data-patient-result").html(data);
                    }
                });
            }

            function editDataPatient() {
                var time_stamp_id = $("#time_stamp_id").val();
                window.location.href = "<?php echo base_url(); ?>dashboard/edit?id="+time_stamp_id;
            }

            function batalBerobat() {
                var r = confirm("Apakah pasien ini batal berobat?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/batalberobat',
                        data: {time_stamp_id:time_stamp_id},
                        beforeSend: function(){
                            $("#loading").show();
                        },
                        complete: function(){
                            $("#loading").hide();
                        },
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

            function kembaliFKTP() {
                var r = confirm("Apakah pasien ini kembali ke Fasilitas Kesehatan Tingkat Pertama?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/kembalifktp',
                        data: {time_stamp_id:time_stamp_id},
                        beforeSend: function(){
                            $("#loading").show();
                        },
                        complete: function(){
                            $("#loading").hide();
                        },
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

            function berobatPoli() {
                var r = confirm("Apakah pasien ini kembali ke poli?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/berobatpoli',
                        data: {time_stamp_id:time_stamp_id},
                        beforeSend: function(){
                            $("#loading").show();
                        },
                        complete: function(){
                            $("#loading").hide();
                        },
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

            function pasienMasuk() {
                var r = confirm("Apakah pasien sudah masuk?");
                if (r) {
                    var time_stamp_id = $("#time_stamp_id").val();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/pasienmasuk',
                        data: {time_stamp_id:time_stamp_id},
                        beforeSend: function(){
                            $("#loading").show();
                        },
                        complete: function(){
                            $("#loading").hide();
                        },
                        success: function (data) {
                            if (data == "merahnotempty") {
                                alert("Masih ada pasien triage merah yang belum masuk");
                                return;
                            } else if (data == "kuningnotempty") {
                                alert("Masih ada pasien triage kuning yang belum masuk");
                                return;
                            } else if (data == "successupdatestatusantrian") {
                                alert("Update pasien masuk berhasil");
                                window.opener.location.reload(true);
                                window.close(); 
                            } else if (data == "masihadanomorkecil") {
                                alert("Dahulukan nomor yang lebih kecil terlebih dahulu");
                                return;
                            } else {
                                alert("Update pasien masuk gagal");
                                return;
                            }
                        }
                    });    
                } else {
                    return false;
                }
                
            }

            function saveDataPatient() {
                var time_stamp_id = $("#time_stamp_id").val();
                var patient_mr = $("#patient_mr").val();
                var patient_fullname = $("#patient_fullname").val();
                var patient_dob = $("#patient_dob").val();
                var patient_title = $("#patient_title").val();

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savedatapatient',
                    data: {time_stamp_id:time_stamp_id, patient_mr:patient_mr, patient_fullname:patient_fullname, patient_dob:patient_dob, patient_title:patient_title},
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
            }

            function deletePatientData() {
                var time_stamp_id = $("#time_stamp_id").val();

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/deletePatientData',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "successdeletepatientdata") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal menghapus data pasien");
                            return;
                        }
                    }
                });
            }

            function panggilAntrian(){
                var time_stamp_id = $("#time_stamp_id").val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/checkwarnaantrian',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "merahnotempty") {
                            alert("Dahulukan antrian triage merah");
                            return;
                        } else if (data == "kuningnotempty") {
                            alert("Dahulukan antrian triage kuning");
                            return;
                        } else if (data == "masihadanomorkecil") {
                            alert("Dahulukan nomor yang lebih kecil terlebih dahulu");
                            return;
                        } else {
                            document.getElementById("suarabel").pause();
                            document.getElementById("suarabel").currentTime=0;
                            document.getElementById("suarabel").play();

                            totalWaktu = document.getElementById("suarabel").duration*2000;

                            setTimeout(function(){
                                document.getElementById("suarabelnomorurut").pause();
                                document.getElementById("suarabelnomorurut").currentTime=0;
                                document.getElementById("suarabelnomorurut").play();
                            }, totalWaktu);
                            totalWaktu = totalWaktu+1800;

                            //play kode warna
                            setTimeout(function(){
                                document.getElementById("kode_warna").pause();
                                document.getElementById("kode_warna").currentTime=0;
                                document.getElementById("kode_warna").play();
                            }, totalWaktu);
                            totalWaktu = totalWaktu+2200;

                            <?php if($antrian < 10){ ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;
                            return;

                            <?php } else if($antrian == 10){ ?>
                                setTimeout(function(){
                                    document.getElementById("sepuluh").pause();
                                    document.getElementById("sepuluh").currentTime=0;
                                    document.getElementById("sepuluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;

                            <?php } elseif ($antrian == 11) { ?>
                                setTimeout(function(){
                                    document.getElementById("sebelas").pause();
                                    document.getElementById("sebelas").currentTime=0;
                                    document.getElementById("sebelas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;
                                // return;

                            <?php } else if ($antrian > 11 && $antrian < 20) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+3400;

                                setTimeout(function(){
                                    document.getElementById("belas").pause();
                                    document.getElementById("belas").currentTime=0;
                                    document.getElementById("belas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;

                            <?php } else if ($antrian == 20) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+3500;

                                setTimeout(function(){
                                    document.getElementById("puluh").pause();
                                    document.getElementById("puluh").currentTime=0;
                                    document.getElementById("puluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;

                            <?php } else if($antrian > 20 && $antrian < 100) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+3500;

                                setTimeout(function(){
                                    document.getElementById("puluh").pause();
                                    document.getElementById("puluh").currentTime=0;
                                    document.getElementById("puluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+2300;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+1000;
                            <?php } else if ($antrian == 100) { ?>
                                setTimeout(function(){
                                    document.getElementById("seratus").pause();
                                    document.getElementById("seratus").currentTime=0;
                                    document.getElementById("seratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 100 && $antrian < 110) { ?>
                                setTimeout(function(){
                                    document.getElementById("seratus").pause();
                                    document.getElementById("seratus").currentTime=0;
                                    document.getElementById("seratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian == 110) { ?>
                                setTimeout(function(){
                                    document.getElementById("seratus").pause();
                                    document.getElementById("seratus").currentTime=0;
                                    document.getElementById("seratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("sepuluh").pause();
                                    document.getElementById("sepuluh").currentTime=0;
                                    document.getElementById("sepuluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if($antrian == 111) { ?>
                                setTimeout(function(){
                                    document.getElementById("seratus").pause();
                                    document.getElementById("seratus").currentTime=0;
                                    document.getElementById("seratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("sebelas").pause();
                                    document.getElementById("sebelas").currentTime=0;
                                    document.getElementById("sebelas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 111 && $antrian < 120) { ?>
                                setTimeout(function(){
                                    document.getElementById("seratus").pause();
                                    document.getElementById("seratus").currentTime=0;
                                    document.getElementById("seratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;
                                
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("belas").pause();
                                    document.getElementById("belas").currentTime=0;
                                    document.getElementById("belas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 119 && $antrian < 200) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("puluh").pause();
                                    document.getElementById("puluh").currentTime=0;
                                    document.getElementById("puluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 199 && $antrian < 210) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("ratus").pause();
                                    document.getElementById("ratus").currentTime=0;
                                    document.getElementById("ratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian == 210) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("ratus").pause();
                                    document.getElementById("ratus").currentTime=0;
                                    document.getElementById("ratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("sepuluh").pause();
                                    document.getElementById("sepuluh").currentTime=0;
                                    document.getElementById("sepuluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian == 211) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("ratus").pause();
                                    document.getElementById("ratus").currentTime=0;
                                    document.getElementById("ratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("sebelas").pause();
                                    document.getElementById("sebelas").currentTime=0;
                                    document.getElementById("sebelas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 211 && $antrian < 220) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;
                                
                                setTimeout(function(){
                                    document.getElementById("ratus").pause();
                                    document.getElementById("ratus").currentTime=0;
                                    document.getElementById("ratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("belas").pause();
                                    document.getElementById("belas").currentTime=0;
                                    document.getElementById("belas").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                            <?php } else if ($antrian > 219 && $antrian < 1000) { ?>
                                setTimeout(function(){
                                    document.getElementById("antrian").pause();
                                    document.getElementById("antrian").currentTime=0;
                                    document.getElementById("antrian").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;
                                
                                setTimeout(function(){
                                    document.getElementById("ratus").pause();
                                    document.getElementById("ratus").currentTime=0;
                                    document.getElementById("ratus").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian1").pause();
                                    document.getElementById("antrian1").currentTime=0;
                                    document.getElementById("antrian1").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("puluh").pause();
                                    document.getElementById("puluh").currentTime=0;
                                    document.getElementById("puluh").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;

                                setTimeout(function(){
                                    document.getElementById("antrian2").pause();
                                    document.getElementById("antrian2").currentTime=0;
                                    document.getElementById("antrian2").play();
                                }, totalWaktu);
                                totalWaktu=totalWaktu+800;
                            <?php } ?>
                        }
                    }
                });
            }
            
            $(document).ready(function () {
                $('#patient_mr').keyPad({
                    template : '#tpl-keypad',
                    isRandom : false,
                });
            });
        </script>
        <script id="tpl-keypad" type="script/template">
        <div class="keypad">
            <table>
                <colgroup>
                    <col width="33.33%">
                    <col width="33.33%">
                    <col width="33.33%">
                </colgroup>
                <tbody>
                    <tr>
                        <td><button type="button" class="1">1</button></td>
                        <td><button type="button" class="2">2</button></td>
                        <td><button type="button" class="3">3</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="4">4</button></td>
                        <td><button type="button" class="5">5</button></td>
                        <td><button type="button" class="6">6</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="7">7</button></td>
                        <td><button type="button" class="8">8</button></td>
                        <td><button type="button" class="9">9</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="text-sm" cmd="clear">Clear</button></td>
                        <td><button type="button" class="0">0</button></td>
                        <td><button type="button" class="text-sm" cmd="back">Back</button></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </script>
	</html>

