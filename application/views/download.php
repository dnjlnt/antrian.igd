<?php 
    
    header("Content-type: application/vnd-ms-excel");    
    header("Content-Disposition: attachment; filename=report_igd_timestamp.xls");
?>
<html lang='en'>
	<head>
		<title>IGD Timestamp</title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
		<script src="<?php echo base_url();?>assets/js/jquery-3.6.0.js"></script>
		<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
        <style>
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
                background: #FFB6C1;
                font-size: 12px;
            }

            .bg-danger {
                background: red;
                font-size: 12px;
            }

            .bg-warning {
                background: yellow;
                font-size: 12px;
            }

            .bg-success {
                background: green;
                font-size: 12px;
            }

            .bg-dark {
                background: black;
                font-size: 12px;
                color: white;
            }
        </style>
	</head>
		<body>
			<div class="wrapper" style="padding:10px;">
                <div class="card">
                    <div style="padding:10px 10px 15px 10px;">
                        <div id="result-report" class="table table-responsive">
                            <?php echo $listReport; ?>
                            <br>
                            <?php echo $tableTotal; ?>
                        </div>
                    </div>
			    </div>
			</div>
		</body>
	</html>

