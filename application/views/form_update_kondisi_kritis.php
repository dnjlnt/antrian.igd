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
                <h5><center><b><u>FORMULIR TRIAGE</u></b></center></h5>
            </div>
            <div class="card bg-light text-dark" style="padding:15px 10px 15px 10px;">
                <form id="form_update_kondisi_kritis">
                    <h6><u>Kondisi Kritis</u></h6>
                    <input type="hidden" value="<?php echo $_GET["id"]; ?>" id="time_stamp_id" name="time_stamp_id">
                    <?php echo $kondisi_kritis; ?>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-block" type="submit">Selanjutnya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#form_update_kondisi_kritis").submit(function(e){
                e.preventDefault(); 

                $.ajax({
                    url:'<?php echo base_url();?>dashboard/updatekondisikritis',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        data = JSON.parse(data);

                        if (data.result == "ESI1" || data.result == "ESI2") {
                            window.location.href = "<?php echo base_url();?>dashboard/doa?id="+data.time_stamp_id+"&dek="+btoa("0")+"&result="+btoa(data.result);
                        } else {
                            window.location.href = "<?php echo base_url();?>dashboard/dekontaminasi?id="+data.time_stamp_id+"&result=";
                        }

                        // alert(data);
                    }
                });
            });
        });
    </script>
</html>

