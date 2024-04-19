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
                    <header><h4><center>Data Pasien</center></h4></header>
                    <br>
                    <div class="form-group">
                        <label><strong>Nama Pasien:</strong></label>
                        <input type="hidden" id="time_stamp_id" name="time_stamp_id" value="<?php echo $_GET["id"]; ?>">
                        <input class="form-control" type="text" id="nama_pasien" name="nama_pasien" value="<?php echo $namaPasien; ?>">
                    </div> 
                    <div class="form-group">
                        <label><strong>Nomor Handphone:</strong></label>
                        <input class="form-control" type="number" id="no_hp" name="no_hp" value="<?php echo $nomorHandphone; ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Tanggal Lahir:</strong></label>
                        <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggalLahir; ?>" format="dd-mm-yyyy">
                    </div>
                    <div class="form-group">
                        <label><strong>Jenis Kelamin:</strong></label><br>
                        <?php echo $jenisKelamin; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" onclick="updatePatient()">Simpan</button>
                    </div>
			    </div>
			</div>
		</body>
        <script>
            setTimeout("window.close()", 600000); 

            function updatePatient() {
                var time_stamp_id = $("#time_stamp_id").val();
                var nama_pasien = $("#nama_pasien").val();
                var no_hp = $("#no_hp").val();
                var tanggal_lahir = $("#tanggal_lahir").val();
                var gender = $("#gender").val();

                if (nama_pasien == "") {
                    alert("Nama pasien tidak boleh kosong");
                    return;
                }

                if (no_hp == "") {
                    alert("Nomor handphone tidak boleh kosong");
                    return;
                }

                if (tanggal_lahir == "") {
                    alert("Tanggal lahir tidak boleh kosong");
                    return;
                }

                if (gender == "Laki-laki") {
                    var gender = "0";
                } else {
                    var gender = "1";
                }

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/update',
                    data: {time_stamp_id:time_stamp_id, nama_pasien:nama_pasien, no_hp:no_hp, tanggal_lahir:tanggal_lahir, gender:gender},
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
        </script>
	</html>

