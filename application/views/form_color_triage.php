<html lang='en'>
	<head>
		<title>IGD Time Stamp</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/jquerymlkeyboard/jquery.ml-keyboard.css">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url();?>assets/jquerymlkeyboard/jquery.ml-keyboard.min.js"></script>
        <style>
            .wrapper {
                padding:20px 20px 10px 20px;
            }
        </style>
	</head>
		<body>
			<div class="wrapper">
                <div class="card bg-light text-dark" style="padding:15px 10px 15px 10px;">
                    <input type="hidden" id="time_stamp_id" value="<?php echo $time_stamp_id; ?>">
                    <div class="row">
                        <div class="col">
                            <button type="submit" onclick="saveTriageRed()" class="btn btn-danger" style="height:100px;width:360px;">Gawat Darurat</button>
                        </div>
                        <div class="col">
                            <button type="submit" onclick="saveTriageYellow()" class="btn btn-warning" style="height:100px;width:350px;">Gawat Tidak Darurat</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <br>
                            <button type="submit" onclick="saveTriageGreen()" class="btn btn-success" style="height:100px;width:360px;">Tidak Gawat, Tidak Darurat</button>
                        </div>
                        <div class="col">
                            <br>
                            <button type="submit" onclick="saveTriageBlack()" class="btn btn-dark" style="height:100px;width:350px;">Meninggal</button>
                        </div>
                    </div>
			    </div>
                <br>
                <small><b>notes:</b><br><span style="color:red;">pilih warna sesuai kondisi pasien</span></small>
			</div>
		</body>
        <script>
            function saveTriageRed() {
                let time_stamp_id = $("#time_stamp_id").val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/savetriagered',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        alert(data);
                        // if (data == "successsavetriage") {
                        //     window.opener.location.reload(true);
                        //     window.close(); 
                        // } else {
                        //     alert("Gagal menambahkan record");
                        //     return;
                        // }
                    }
                });
            }

            function saveTriageYellow() {
                let time_stamp_id = $("#time_stamp_id").val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/saveTriageYellow',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "successsavetriage") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal menambahkan record");
                            return;
                        }
                    }
                });
            }

            function saveTriageGreen() {
                let time_stamp_id = $("#time_stamp_id").val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/saveTriageGreen',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "successsavetriage") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal menambahkan record");
                            return;
                        }
                    }
                });
            }

            function saveTriageBlack() {
                let time_stamp_id = $("#time_stamp_id").val();
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/saveTriageBlack',
                    data: {time_stamp_id:time_stamp_id},
                    success: function (data) {
                        if (data == "successsavetriage") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal menambahkan record");
                            return;
                        }
                    }
                });
            }
        </script>
	</html>

