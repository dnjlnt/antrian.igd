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
            .wrapper { padding:20px 20px 10px 20px; text-align:center;}
        </style>
	</head>
		<body>
			<div class="wrapper">
                <input type="hidden" id="ts_id" value="<?php echo $time_stamp_id;?>">
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-block btn-danger" style="height:150px;" onclick="deleteRecordTriage()">Hapus Triage</button>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url();?>dashboard/triage?id=<?php echo $time_stamp_id;?>" class="btn btn-block btn-secondary" style="height:150px;padding-top:60px;">
                            Ubah Warna Triage
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url();?>dashboard/cetak_antrian?ts_id=<?php echo $time_stamp_id;?>" class="btn btn-block btn-primary" style="height:150px;padding-top:60px;">
                            Cetak Antrian
                        </a>
                    </div>
                </div>
                <hr>
                <div style="text-align:left;">
                    <small><b>notes:</b><br><span style="color:red;">Update warna triage tidak akan merubah waktu sebelumnya</span></small>
                </div>
			</div>
		</body>
        <script>
            setTimeout("window.close()", 600000); 

            function deleteRecordTriage() {
                var ts_id = $("#ts_id").val();
                var result = confirm('Hapus record?');
                if(result){
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url();?>dashboard/removepatienttriage',
                        data: {ts_id:ts_id},
                        success: function (data) {
                            if (data == 'successremovepatient') {
                                window.opener.location.reload(true);
                                window.close(); 
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
        </script>
	</html>

