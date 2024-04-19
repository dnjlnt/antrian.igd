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
        </style>
        
	</head>
		<body>
			<div class="wrapper" style="padding:10px;">
                <div class="card">
                    <div style="padding:10px 10px 15px 10px;">
                        <table>
                            <tr>
                                <td>Dari Tanggal</td>
                                <td>: <input type="date" id="from_date"></td>
                            </tr>
                            <tr>
                                <td>Sampai Tanggal</td>
                                <td>: <input type="date" id="to_date"></td>
                            </tr>
                            <tr>
                                <td>Jenis Laporan</td>
                                <td>
                                    : 
                                    <select id="report_type">
                                        <option value="0">Timestamp</option>
                                        <option value="1">Waktu Tunggu</option>
                                        <option value="2">Hasil TTV</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-sm btn-block btn-info" onclick="getReport()" style="margin-top:10px;">Cari Data</button>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div id="result-report" class="table table-responsive"></div>
                    </div>
			    </div>
			</div>
		</body>
        <script>
            function getReport() {
                let from_date = $("#from_date").val();
                let to_date = $("#to_date").val();
                let report_type = $("#report_type").val();
                let notes = "";
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>report/getreport',
                    data: {from_date:from_date, to_date:to_date, report_type:report_type, notes:notes},
                    success: function (data) {
                        $("#result-report").html(data);
                    }
                });
            }

            function downloadReport(from_date, to_date) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>report/downloadreport',
                    data: {from_date:from_date, to_date:to_date},
                    success: function (data) {
                        
                    }
                });
            }
        </script>
	</html>

