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
                <h5><center><b><u>FORMULIR TANDA-TANDA VITAL</u></b></center></h5>
            </div>
            <div class="card bg-light text-dark" style="padding:15px 10px 15px 10px;">
                <form id="form_update_ttv">
                    <div class="form-group">
                        <label class="form-check-label" for="tekanan_darah"><strong>Tekanan Darah Sistolik *</strong></label>
                        <input type="hidden" id="time_stamp_id" name="time_stamp_id" value="<?php echo $_GET["id"]; ?>">
                        <input type="hidden" id="dekontaminasi" name="dekontaminasi" value="<?php echo $_GET["dek"]; ?>">
                        <input type="hidden" id="doa" name="doa" value="<?php echo $_GET["doa"]; ?>">
                        <input type="hidden" id="result" name="result" value="<?php echo $_GET["result"]; ?>">
                        
                        <input class="form-control" type="number" id="tekanan_darah_sistolik" name="tekanan_darah_sistolik" value="<?php echo $tekanan_darah_sistolik; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="tekanan_darah"><strong>Tekanan Darah Diastolik *</strong></label>
                        <input class="form-control" type="number" id="tekanan_darah_diastolik" name="tekanan_darah_diastolik" value="<?php echo $tekanan_darah_diastolik; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="respirasi"><strong>Respirasi *</strong></label>
                        <input class="form-control" type="number" id="respirasi" name="respirasi" value="<?php echo $respirasi; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="saturasi"><strong>Saturasi O2 *</strong></label>
                        <input class="form-control" type="number" id="saturasi" name="saturasi" value="<?php echo $saturasi; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="nadi"><strong>Nadi *</strong></label>
                        <input class="form-control" type="number" id="nadi" name="nadi" value="<?php echo $nadi; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="suhu"><strong>Suhu *</strong></label>
                        <input class="form-control" type="text" id="suhu" name="suhu" value="<?php echo $suhu; ?>">
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-block" type="submit">Selanjutnya</button>
                            <button class="btn btn-danger btn-block" onclick="history.back()">Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#form_update_ttv").submit(function(e){
                e.preventDefault(); 

                if ($("#tekanan_darah_sistolik").val() == "") {
                    alert("Tekanan darah sistolik tidak boleh kosong");
                    return;
                }

                if ($("#tekanan_darah_diastolik").val() == "") {
                    alert("Tekanan darah diastolik tidak boleh kosong");
                    return;
                }

                if ($("#respirasi").val() == "") {
                    alert("Respirasi tidak boleh kosong");
                    return;
                }

                if ($("#saturasi").val() == "") {
                    alert("Saturasi tidak boleh kosong");
                    return;
                }

                if ($("#nadi").val() == "") {
                    alert("Nasi tidak boleh kosong");
                    return;
                }

                if ($("#suhu").val() == "") {
                    alert("Suhu tidak boleh kosong");
                    return;
                }

                $.ajax({
                    url:'<?php echo base_url();?>dashboard/updatettv',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        // alert(data);
                        data = JSON.parse(data);

                        if (data.result == "") {
                            window.location.href = "<?php echo base_url();?>dashboard/resources?id="+data.time_stamp_id+"&dek="+data.dekontaminasi+"&doa="+data.doa+"&ttv=1";
                        } else {
                            window.opener.location.reload(true);
                            window.close(); 
                        }

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
            });
        });
    </script>
</html>

