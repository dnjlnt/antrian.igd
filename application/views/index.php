<?php 
    if (isset($_GET['action'])) {
        $meta = "<meta http-equiv='refresh' content='30'>";
        $script = "<script>
                    window.onload = function() { jam(); }

                    function jam() {
                        var e = document.getElementById('clock'),
                        d = new Date(), h, m, s;
                        h = d.getHours();
                        m = set(d.getMinutes());
                        s = set(d.getSeconds());
                    
                        e.innerHTML = ('0' + h).substr(-2) +':'+ m +':'+ s;
                    
                        setTimeout('jam()', 1000);
                    }
                    
                    function set(e) {
                        e = e < 10 ? '0'+ e : e;
                        return e;
                    }
                  </script>";
    } else {
        $meta = "";
        $script = "";
    }
?>

<html lang='en'>
	<head>
        <?php echo $meta; ?>
		<title>IGD Timestamp</title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
		<script src="<?php echo base_url();?>assets/js/jquery-3.6.0.js"></script>
		<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
        <style>
            .trhead {
                height: 10px;
            }
            
            .lightgrey {
                background:  #D3D3D3;
                font-size: 12px;
            }

            .papayawhip {
                background: #FFEFD5;
                font-size: 12px;
            }

            .peachpuff {
                background: #FFDAB9;
                font-size: 12px;
            }

            .lightblue {
                background: #ADD8E6;
                font-size: 12px;
            }

            .zephyrgreen {
                background: #7CB083;
                font-size: 12px;
            }

            .pastelmint {
                background: #CEF0CC;
                font-size: 12px;
            }

            .lightpink {
                background: #fdffc4;
                font-size: 12px;
            }

            .nocolor {
                background: #ffffff;
                font-size: 12px;
            }

            .btn_men {
                background-image: url("<?php echo base_url();?>assets/img/men.png");
                background-repeat: no-repeat;
                background-size: cover;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                font-size: 30px;
                cursor: pointer;
            }

            /* Darker background on mouse-over */
            .btn_men:hover {
                background-color: blue;
            }

            .btn_women {
                background-image: url("<?php echo base_url();?>assets/img/women_pink.png");
                background-repeat: no-repeat;
                background-size: cover;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                font-size: 30px;
                cursor: pointer;
            }

            /* Darker background on mouse-over */
            .btn_women:hover {
                background-color: ;
            }

            .btn_click {
                background-image: url("<?php echo base_url();?>assets/img/btnclick.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                border: none;
                width: 70px;
                height: 23px;
                cursor: pointer;
            }

            .btn_swap {
                background-image: url("<?php echo base_url();?>assets/img/remove.png");
                background-repeat: no-repeat;
                background-size: cover;
                border: none;
                width: 20px;
                height: 20px;
                cursor: pointer;
            }

            .btn_remove {
                /* background-image: url("<?php echo base_url();?>assets/img/remove2.png"); */
                background: #DCDCDC;
                color: #000000;
                background-repeat: no-repeat;
                background-size: cover;
                border: none;
                width: 20px;
                height: 20px;
                cursor: pointer;
                border-radius:50%;
                padding-bottom: 3px;
            }

            .btn_remove:hover {
                /* background-image: url("<?php echo base_url();?>assets/img/remove2.png"); */
                background: grey;
            }

            th {
                padding-bottom: 12px;
            }
            thead tr:nth-child(1) th { position: sticky; top: 0; background: #ffffff; border: 1px solid black;}
            thead tr:nth-child(2) th { position: sticky; top: 91px; border: 1px solid black;}
            thead tr:nth-child(3) th { position: sticky; top: 145px; border: 1px solid black;}
        </style>
	</head>
		<body>
			<div class="wrapper">
				<div class="table">
					<table class="table table-bordered" style="text-align:center;">
						<thead>
                            <tr>
								<th colspan="3" style="border:none;text-align:left;padding-top:0px;">
                                    <button class="btn_men" onclick="addPatientMen()"></button>
                                    <button class="btn_women" onclick="addPatientWomen()"></button>
                                    <br>
                                    <span style="font-size:10px;color:red;">*Klik untuk menambahkan pasien</span>
                                </th>
                                <th colspan="7" style="border:none;text-align:left;">
                                    <h3>
                                        <strong>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            IGD Timestamp
                                        </strong>
                                    </h3>
                                </th>
								<th colspan="3" style="border:none;text-align:right;">
                                    <img src="<?php echo base_url();?>assets/img/Logo-CH.png" class="img-responsive" id="logo-ch" width="180">
                                    <br>
                                    <div style="margin-top:5px;">
                                        <span style="font-size:12px;"><?php echo date_indo(date("Y-m-d"));?><span><br>
                                        <span id="clock"></span>
                                    </div>
                                </th>
							</tr>
							<tr>
								<th rowspan="2" class="lightgrey" style="padding-bottom: 35px;border: 1px solid black;">No.</th>
								<th rowspan="2" class="lightgrey" style="padding-bottom: 35px;border: 1px solid black;">Nama</th>
								<th rowspan="2" class="peachpuff" style="padding-bottom: 35px;border: 1px solid black;">Pasien Datang</th>
								<th rowspan="2" class="papayawhip" style="padding-bottom: 35px;border: 1px solid black;">Triage</th>
								<th rowspan="2" class="lightgrey" style="padding-bottom: 35px;border: 1px solid black;">No. Bed</th>
								<th rowspan="2" class="lightpink" style="padding-bottom: 35px;border: 1px solid black;">Pemeriksaan Dr. IGD</th>
								<th rowspan="2" class="lightpink" style="padding-bottom: 35px;border: 1px solid black;">Pemeriksaan DPJP</th>
								<th colspan="2" class="lightblue" style="border: 1px solid black;">Observasi/Tindakan</th>
								<th rowspan="2" class="pastelmint" style="padding-bottom: 35px;border: 1px solid black;">Pasien Pulang</th>
								<th rowspan="2" class="zephyrgreen" style="padding-bottom: 25px;border: 1px solid black;">Pasien Transfer Rawat Inap</th>
								<th rowspan="2" class="lightgrey" style="padding-bottom: 25px;border: 1px solid black;">Pasien Khusus</th>
								<th rowspan="2" class="lightgrey" style="padding-bottom: 25px;border: 1px solid black;">
                                    Hapus Tampilan<br><small style="color:red;">(Tidak Menghapus Data)</small>
                                </th>
							</tr>
							<tr>
								<th class="lightblue" style="border: 1px solid black;">Mulai</th>
								<th class="lightblue" style="border: 1px solid black;">Selesai</th>
							</tr>
						</thead>
						<tbody id='row-list-patient'>
                            <?php echo $listPatient; ?>
						</tbody>
					</table>
				</div>
			</div>
		</body>
        <div class="modal fade" id="modal-patient-mr" tabindex="-1" role="dialog" aria-hidden="true"></div>
        <script>
            window.onload = function() { 
                jam(); getData();
            }
    
            function jam() {
                var e = document.getElementById('clock'),
                d = new Date(), h, m, s;
                h = d.getHours();
                m = set(d.getMinutes());
                s = set(d.getSeconds());
            
                e.innerHTML = ('0' + h).substr(-2) +':'+ m +':'+ s;
            
                setTimeout('jam()', 1000);
            }
            
            function set(e) {
                e = e < 10 ? '0'+ e : e;
                return e;
            }

            function getData() {
                $.ajax({
                    type: 'get',
                    url: '<?php echo base_url();?>dashboard/getlistdata',
                    success: function (data) {
                        $('#row-list-patient').html(data);
                        setTimeout('getData()', 10000);
                    }
                });
                
            }
        
            $(document).ready(function(){
                $('.patient_mr').click(function(){
                    var id = $(this).attr('data-timestamp-id');
                    var left = (screen.width - 2000) / 2;
                    var top = (screen.height - 1200) / 4;
                    window.open('<?php echo base_url();?>dashboard/formdatapasien?id='+id, '_blank', 'toolbar=no, location=no, menubar=0, top='+ top + ', left=' + left + ', height=1200, width=2000, scrollbars=yes');
                });
            });

            $(document).ready(function(){
                $('.patient_bed').click(function(){
                    var id = $(this).attr('data-timestamp-id');
                    var left = (screen.width - 500) / 2;
                    var top = (screen.height - 600) / 4;
                    window.open('<?php echo base_url();?>dashboard/formbedpatient/'+id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=400, width=600, scrollbars=1');
                });
            });

            $(document).ready(function(){
                $('.patient_special').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus pasien khusus?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientkhusus',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_come').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientcome',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_triage').click (function() {
                    var id = $(this).attr('data-timestamp-id');
                    var left = (screen.width - 800) / 2;
                    var top = (screen.height - 700) / 4;
                    window.open('<?php echo base_url();?>dashboard/formupdatetriage?id='+id, '_blank', 'toolbar=no, location=no, menubar=0, top='+ top + ', left=' + left + ', height=700, width=800, scrollbars=yes');
                });
            });

            $(document).ready(function(){
                $('.patient_checkup').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientcheckup',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_checkup_dpjp').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientcheckupdpjp',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_obstart').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientobstart',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_obfinish').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientobfinish',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_go').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatientgo',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function(){
                $('.patient_transfer').click (function(){
                    var id = $(this).attr('data-timestamp-id');
                    var result = confirm('Hapus record?');
                    if(result){
                        $.ajax({
                            type: 'post',
                            url: '<?php echo base_url();?>dashboard/removepatienttransfer',
                            data: {ts_id:id},
                            success: function (data) {
                                if (data == 'successremovepatient') {
                                    window.location.reload();
                                } else {
                                    alert('Gagal menghapus data');
                                    return;
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            function getPatientTriageXX(time_stamp_id) {
                var left = (screen.width - 1400) / 2;
                var top = (screen.height - 800) / 4;
                window.open('<?php echo base_url();?>dashboard/colortriage?id='+time_stamp_id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=800, width=1400, scrollbars=1');
            }

            function getPatientTriage(time_stamp_id) {
                var left = (screen.width - 900) / 2;
                var top = (screen.height - 900) / 4;
                window.open('<?php echo base_url();?>dashboard/triage?id='+time_stamp_id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=900, width=900, scrollbars=1');
            }

            function patientKhusus(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientkhusus',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientkhusus') {
                            window.location.reload();
                        } else {
                            alert('Gagal merubah pasien khusus');
                            return;
                        }
                    }
                });
            }

            function addPatientMenXX() {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/addpatientmen',
                    data: {},
                    success: function (data) {
                        if (data == 'successsavepatient') {
                            window.location.reload();
                        } else {
                            alert('Gagal menambahkan pasien baru');
                            return;
                        }
                    }
                });
            }

            function addPatientMen() {
                var left = (screen.width - 800) / 2;
                var top = (screen.height - 700) / 4;
                window.open('<?php echo base_url();?>dashboard/addpatient?gender=male', '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=700, width=800, scrollbars=1');
            }

            function addPatientWomenXX() {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/addpatientwomen',
                    data: {},
                    success: function (data) {
                        if (data == 'successsavepatient') {
                            window.location.reload();
                        } else {
                            alert('Gagal menambahkan pasien baru');
                            return;
                        }
                    }
                });
            }

            function addPatientWomen() {
                var left = (screen.width - 800) / 2;
                var top = (screen.height - 700) / 4;
                window.open('<?php echo base_url();?>dashboard/addpatient?gender=female', '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=700, width=800, scrollbars=1');
            }

            function deletePatientData(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/deletepatientdata',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successdeletepatientdata') {
                            window.location.reload();
                        } else {
                            alert('Gagal hapus pasien');
                            return;
                        }
                    }
                });
            }

            function patientCome(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientcome',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientcome') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientCheckup(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientcheckup',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientcheckup') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientCheckupDpjp(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientcheckupdpjp',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientcheckupdpjp') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientObStart(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientobstart',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientobstart') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientObFinish(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientobfinish',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientobfinish') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientGoXX(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatientgo',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatientgo') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientGo(ts_id) {
                var left = (screen.width - 800) / 2;
                var top = (screen.height - 700) / 4;
                window.open('<?php echo base_url();?>dashboard/choosepatientgo?id='+ts_id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=700, width=800, scrollbars=1');
            }

            function patientTransfer(ts_id) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savepatienttransfer',
                    data: {ts_id:ts_id},
                    success: function (data) {
                        if (data == 'successsavepatienttransfer') {
                            window.location.reload();
                        } else {
                            alert('Gagal record data');
                            return;
                        }
                    }
                });
            }

            function patientSwap2(ts_id) {
                var result = confirm('Hapus nama pasien dari tampilan?');
                if(result){
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/removepatient',
                        data: {ts_id:ts_id},
                        success: function (data) {
                            if (data == 'successremovepatient') {
                                window.location.reload();
                            } else {
                                alert('Gagal menghapus data');
                                return;
                            }
                        }
                    });
                } else {
                    return false;
                }
            }

            function patientSwap(ts_id) {
                var left = (screen.width - 800) / 2;
                var top = (screen.height - 300) / 4;
                window.open('<?php echo base_url();?>dashboard/password?id='+ts_id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=300, width=800, scrollbars=1');
                // var result = confirm('Hapus nama pasien dari tampilan?');
                // if(result){
                //     $.ajax({
                //         type: 'post',
                //         url: '<?php echo base_url();?>dashboard/removepatient',
                //         data: {ts_id:ts_id},
                //         success: function (data) {
                //             if (data == 'successremovepatient') {
                //                 window.location.reload();
                //             } else {
                //                 alert('Gagal menghapus data');
                //                 return;
                //             }
                //         }
                //     });
                // } else {
                //     return false;
                // }
            }

        $(document).ready(function(){
            setInterval(function(){
                    $('#here').load(window.location.href + ' #here' );
            }, 1000);
        });
        </script>
	</html>

