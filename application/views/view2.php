<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Antrian IGD Ciputra Hospital - Citra Raya Tangerang</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            html, body {
                height: 100%;
                width: 100%;
                margin: 0;
                overflow: hidden;
                background-image: linear-gradient(#ffffff, #3dffff);
            }

            .marquee-text {
                width: 100%;
                background: #FEECC8;
                height: 60px;
                display: block;
                line-height: 30px;
                overflow: hidden;
                position: fixed;
                left: 0;
                bottom: 0;
            }

            .marquee-text:before,
            .marquee-text:after {
                content: '';
                position: absolute;
                width: 5px;
                height: 100%;
                top: 0;
                z-index: 2;
            }

            .marquee-text:before {
                left: 0;
            }

            .marquee-text:after {
                right: 0;
            }

            .marquee-text div {
                padding-top: 17px;
                height: 30px;
                line-height: 30px;
                font-size: 30px;
                white-space: nowrap;
                color: #000;
                z-index: 1;
                animation: marquee 25s linear infinite;
            }

            @keyframes marquee {
                0% { 
                    transform: translateX(100%); 
                }
                100% { 
                    transform: translateX(-100%); 
                }
            }
        </style>
        <script>
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
          </script>
    </head>
    <body>
        <div class="jumbotron text-center" style="padding-top:10px;padding-bottom:10px;background:none;">
            <div class="row" style="margin:0px;">
                <div class="col-sm-3" style="text-align:center;">
                    <img src="<?php echo base_url();?>assets/logo_ch_crt.png" class="img-responsive" id="logo-ch" width="300" style="padding: 20px 0px 0px 20px;">
                </div>
                <div class="col-sm-6">
                    <h1>ANTRIAN IGD</h1>
                    <p><strong>Ciputra Hospital - Citra Raya Tangerang</strong></p>
                </div>
                <div class="col-sm-3">
                    <div style="margin-top:20px;margin-right:-100px;">
                        <span style="font-size:20px;">
                            <?php echo date_indo("Y-m-d");?>
                        <span>
                        <br>
                        <span id="clock"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" style="margin:0px;">
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid #C0C0C0;border-radius:5px;padding:0px 10px 10px 10px;">
                        <div class="card-header" align="center">
                            <h2 style="color:#2700c4;"><strong>PRIORITAS I</strong></h2>
                        </div>
                        <hr style="background:#2700c4;">
                        <div class="card-body" style="height: 650px;">
                            <div id="list-antrian-merah">
                                <?php echo $listAntrianMerah; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid #C0C0C0;border-radius:5px;padding:0px 10px 10px 10px;">
                        <div class="card-header" align="center">
                            <h2 style="color:#2700c4;"><strong>PRIORITAS II</strong></h2>
                        </div>
                        <hr style="background:#2700c4;">
                        <div class="card-body" style="height: 650px;">
                            <div id="list-antrian-kuning">
                                <?php echo $listAntrianKuning; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid #C0C0C0;border-radius:5px;padding:0px 10px 10px 10px;">
                        <div class="card-header" align="center">
                            <h2 style="color:#2700c4;"><strong>PRIORITAS III</strong></h2>
                        </div>
                        <hr style="background:#2700c4;">
                        <div class="card-body" style="height: 650px;">
                            <div id="list-antrian-hijau">
                                <?php echo $listAntrianHijau; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-fixed-bottom">
                <div class="marquee-text" style="margin-bottom:10px;">
                    <div>
                        ANTRIAN PASIEN AKAN MENGIKUTI PRIORITAS LAYANAN PASIEN
                    </div>
                </div>
            </div>
            <!-- <div class="navbar navbar-fixed-bottom">
                <div class="marquee-text">
                    <div>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url();?>assets/Logo-CH.png" class="img-responsive">
                        </div>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url();?>assets/Logo-CH.png" class="img-responsive">
                        </div>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url();?>assets/Logo-CH.png" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </body>
    <script>
        $(document).ready(function() {
            window.setInterval(function(){
                $("#list-antrian-merah").load(window.location.href + " #list-antrian-merah" );
                $("#list-antrian-kuning").load(window.location.href + " #list-antrian-kuning" );
                $("#list-antrian-hijau").load(window.location.href + " #list-antrian-hijau" );
            }, 1000);
        });
    </script>
</html>