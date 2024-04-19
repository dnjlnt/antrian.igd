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
            <div class="header">
                <h5><center><b><u>SUMBER DAYA IGD YANG DIBUTUHKAN</u></b></center></h5>
            </div>
            <div class="card bg-light text-dark" style="padding:15px 10px 15px 10px;">
                <form id="form_resources">
                    <div class="form-check">
                        <input type="hidden" name="time_stamp_id" id="time_stamp_id" value="<?php echo $_GET["id"]; ?>">
                        <input type="hidden" name="dekontaminasi" id="dekontaminasi" value="<?php echo $_GET["dek"]; ?>">
                        <input type="hidden" name="doa" id="doa" value="<?php echo $_GET["doa"]; ?>">
                        <input type="hidden" name="ttv" id="ttv" value="<?php echo $_GET["ttv"]; ?>">
                        <input class="form-check-input" type="radio" name="resources" id="resources_no" value="0">
                        <label class="form-check-label" for="resources_no">
                            Tidak Ada
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="resources" id="resources_1" value="1">
                        <label class="form-check-label" for="resources_1">
                            1 - 2 Buah (Radiologi/Lab)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="resources" id="resources_2" value="2">
                        <label class="form-check-label" for="resources_2">
                            Lebih Dari > 2 (Radiologi/Lab/Tindakan Medis)
                        </label>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-block" type="submit">Selanjutnya</button>
                            <button class="btn btn-danger btn-block" onclick="history.back()">Kembali</button>
                        </div>
                    </div>
                </form>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#form_resources").submit(function(e){
                e.preventDefault(); 

                $.ajax({
                    url:'<?php echo base_url();?>dashboard/saveresources',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        data = JSON.parse(data);

                        if (data.message == "success") {
                            window.opener.location.reload(true);
                            window.close(); 
                        } else {
                            alert("Gagal memperoleh hasil data triage");
                            return;
                        }

                        // alert(data);
                    }
                });
            });
        });
    </script>
</html>

