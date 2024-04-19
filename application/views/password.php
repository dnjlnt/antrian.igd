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
                <div class="form-group">
                    <label class="form-check-label" for="tekanan_darah"><strong>Masukkan Password</strong></label>
                    <input type="hidden" id="time_stamp_id" name="time_stamp_id" value="<?php echo $_GET["id"]; ?>">
                    
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-block" onclick="deleteData()">Hapus Data</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function deleteData() {
            var ts_id = $("#time_stamp_id").val();
            var password = $("#password").val();

            if (password != "igd") {
                alert("Password salah");
                return;
            } else {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>dashboard/removepatient',
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
            }
        }
    </script>
</html>

