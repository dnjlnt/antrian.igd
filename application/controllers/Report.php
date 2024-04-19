<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Report extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }
	
	public function index() {
		$this->load->view("report.php");
	}

	public function getReport() {
        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        $prefmr = "01";

		$from_date = $this->input->post("from_date");
		$to_date = $this->input->post("to_date");
        $report_type = $this->input->post("report_type");
        $notes = $this->input->post("notes");

        if ($notes == "") {
            $saveNotes = "";
        } else {
            $saveNotes = $this->ModelDashboard->saveNotes();
        }

        if ($report_type == "0") {
            $listReport = "<table class='table'>
                            <thead>
                            <tr>
                                <th colspan='14' style='border-bottom: 1px solid black;border-top:none;'>
                                    IGD Timestamp Report ".date_indo($from_date)." - ".date_indo($to_date)."
                                </th>
                                <th style='float:right;border-top:none;'>
                                    <a class='btn btn-sm btn-secondary' style='font-size:12px;' href='".base_url()."report/downloadreport/".$from_date."/".$to_date."/0'>Download Excel</button>
                                </th>
                            </tr>
                            <tr style='text-align:center;'>
                                <th class='lightgrey' style='border: 1px solid black;width:50px;'>No.</th>
                                <th class='lightgrey' style='border: 1px solid black;width:100px;'>No. RM</th>
                                <th class='lightgrey' style='border: 1px solid black;width:200px;'>Nama</th>
                                <th class='lightgrey' style='border: 1px solid black;width:200px;'>Nomor Handphone</th>
                                <th class='peachpuff' style='border: 1px solid black;width:120px;'>Pasien Datang</th>
                                <th class='papayawhip' style='border: 1px solid black;width:120px;'>Triage</th>
                                <th class='lightpink' style='border: 1px solid black;width:120px;'>Pemeriksaan Dr.</th>
                                <th class='lightblue' style='border: 1px solid black;width:110px;'>Observasi/Tindakan Mulai</th>
                                <th class='lightblue' style='border: 1px solid black;width:110px;'>Observasi/Tindakan Selesai</th>
                                <th class='pastelmint' style='border: 1px solid black;width:120px;'>Pasien Pulang</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Pasien Transfer Rawat Inap</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Pasien Khusus</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Hasil ESI</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Keterangan</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Keterangan Pasien Pulang</th>
                            </tr>
                            </thead>
                            <tbody>";

            $getData = $this->ModelDashboard->getDataReport($from_date, $to_date);
            if ($getData !== false) {
            $no = 0;
            foreach ($getData as $row) {
                $no++;

                $result = $row->result;

                if ($row->patient_notes == "kembali_ke_fktp") {
                    $patient_notes = "Kembali ke Faskes Tingkat 1";
                } else if ($row->patient_notes == "berobat_ke_poli") {
                    $patient_notes = "Berobat ke Poli";
                } else if ($row->patient_notes == "batal_berobat") {
                    $patient_notes = "Batal Berobat";
                } else {
                    $patient_notes = $row->patient_notes;
                }

                if ($row->patient_go_notes == "pasien_dirujuk") {
                    $patient_go_notes = "Pasien Dirujuk";
                } else if ($row->patient_go_notes == "meninggal_dunia") {
                    $patient_go_notes = "Pasien Meninggal Dunia";
                } else if ($row->patient_go_notes == "permintaan_sendiri") {
                    $patient_go_notes = "Pasien Pulang Atas Permintaan Sendiri";
                } else if ($row->patient_go_notes == "instruksi_dokter") {
                    $patient_go_notes = "Pasien Pulang Atas Instruksi Dokter";
                } else {
                    $patient_go_notes = $row->patient_go_notes;
                }

                if ($row->patient_mr == "") {
                    $patient_mr = "";
                } else {
                    if (strlen($row->patient_mr) == "1" || strlen($row->patient_mr) == 1) {
                        $patient_mr = "".$prefmr."-0000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "2" || strlen($row->patient_mr) == 2) {
                        $patient_mr = "".$prefmr."-000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "3" || strlen($row->patient_mr) == 3) {
                        $patient_mr = "".$prefmr."-00000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "4" || strlen($row->patient_mr) == 4) {
                        $patient_mr = "".$prefmr."-0000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "5" || strlen($row->patient_mr) == 5) {
                        $patient_mr = "".$prefmr."-000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "6" || strlen($row->patient_mr) == 6) {
                        $patient_mr = "".$prefmr."-00".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "7" || strlen($row->patient_mr) == 7) {
                        $patient_mr = "".$prefmr."-0".$row->patient_mr;
                    } else {
                        $patient_mr = "".$prefmr."-".$row->patient_mr;
                    }
                }

                if ($row->patient_come == "0000-00-00 00:00:00") {
                    $patient_come = "";
                } else {
                    $patient_come = explode(" ", $row->patient_come);
                    $patient_come_date = $patient_come[0];
                    $patient_come_time = $patient_come[1];

                    $patient_come = "<center>".date_indo($patient_come_date)."<br>".$patient_come_time."<center>";
                }

                if ($row->patient_triage == "0000-00-00 00:00:00") {
                    $patient_triage = "";
                    $bgtriage = "";
                    $color = "color:#000;";
                } else {
                    if ($row->triage_color == "red") {
						$bgtriage = "bg-danger";
						$color = "color:#000;";
					} else if ($row->triage_color == "green") {
						$bgtriage = "bg-success";
						$color = "color:#000;";
					} else if ($row->triage_color == "yellow") {
						$bgtriage = "bg-warning";
						$color = "color:#000;";
					} else {
						$bgtriage = "bg-dark";
						$color = "color:#fff;";
					}
                    $patient_triage = explode(" ", $row->patient_triage);
                    $patient_triage_date = $patient_triage[0];
                    $patient_triage_time = $patient_triage[1];

                    $patient_triage = "<center>".date_indo($patient_triage_date)."<br>".$patient_triage_time."</center>";
                }

                if ($row->patient_checkup == "0000-00-00 00:00:00") {
                    $patient_checkup = "";
                } else {
                    $patient_checkup = explode(" ", $row->patient_checkup);
                    $patient_checkup_date = $patient_checkup[0];
                    $patient_checkup_time = $patient_checkup[1];

                    $patient_checkup = "<center>".date_indo($patient_checkup_date)."<br>".$patient_checkup_time."</center>";
                }

                if ($row->patient_observation_start == "0000-00-00 00:00:00") {
                    $patient_observation_start = "";
                } else {
                    $patient_observation_start = explode(" ", $row->patient_observation_start);
                    $patient_observation_start_date = $patient_observation_start[0];
                    $patient_observation_start_time = $patient_observation_start[1];

                    $patient_observation_start = "<center>".date_indo($patient_observation_start_date)."<br>".$patient_observation_start_time."</center>";
                }

                if ($row->patient_observation_finish == "0000-00-00 00:00:00") {
                    $patient_observation_finish = "";
                } else {
                    $patient_observation_finish = explode(" ", $row->patient_observation_finish);
                    $patient_observation_finish_date = $patient_observation_finish[0];
                    $patient_observation_finish_time = $patient_observation_finish[1];

                    $patient_observation_finish = "<center>".date_indo($patient_observation_finish_date)."<br>".$patient_observation_finish_time."</center>";
                }

                if ($row->patient_go == "0000-00-00 00:00:00") {
                    $patient_go = "";
                } else {
                    $patient_go = explode(" ", $row->patient_go);
                    $patient_go_date = $patient_go[0];
                    $patient_go_time = $patient_go[1];

                    $patient_go = "<center>".date_indo($patient_go_date)."<br>".$patient_go_time."<center>";
                }

                if ($row->patient_transfer == "0000-00-00 00:00:00") {
                    $patient_transfer = "";
                } else {
                    $patient_transfer = explode(" ", $row->patient_transfer);
                    $patient_transfer_date = $patient_transfer[0];
                    $patient_transfer_time = $patient_transfer[1];

                    $patient_transfer = "<center>".date_indo($patient_transfer_date)."<br>".$patient_transfer_time."</center>";
                }

                if ($row->patient_khusus == "1") {
                    $patient_khusus = "<center>Pasien Khusus</center>";
                } else {
                    $patient_khusus = "";
                }

                $listReport .= "<tr style='font-size:11px;'>
                                    <td style='border: 1px solid black;'>".$no.".</td>
                                    <td style='border: 1px solid black;'>".$patient_mr."</td>
                                    <td style='border: 1px solid black;'>".$row->patient_name."</td>
                                    <td style='border: 1px solid black;'>".$row->patient_phone_number."</td>
                                    <td style='border: 1px solid black;'>".$patient_come."</td>
                                    <td style='border: 1px solid black;".$color."' class='".$bgtriage."'>".$patient_triage."</td>
                                    <td style='border: 1px solid black;'>".$patient_checkup."</td>
                                    <td style='border: 1px solid black;'>".$patient_observation_start."</td>
                                    <td style='border: 1px solid black;'>".$patient_observation_finish."</td>
                                    <td style='border: 1px solid black;'>".$patient_go."</td>
                                    <td style='border: 1px solid black;'>".$patient_transfer."</td>
                                    <td style='border: 1px solid black;'>".$patient_khusus."</td>
                                    <td style='border: 1px solid black;'>".$result."</td>
                                    <td style='border: 1px solid black;'>".$patient_notes."</td>
                                    <td style='border: 1px solid black;'>".$patient_go_notes."</td>
                                </tr>";
            }
            } else {
                $listReport .= "<tr><td colspan='11' class='bg-danger' align='center' style='border:1px solid black;color:#fff;'>Tidak ada data</td></tr>";
            }

            $listReport .= "</tbody></table>";

            $totalTriageBlack = $this->ModelDashboard->getTotalTriageBlack($from_date, $to_date);
            $totalTriageRed = $this->ModelDashboard->getTotalTriageRed($from_date, $to_date);
            $totalTriageYellow = $this->ModelDashboard->getTotalTriageYellow($from_date, $to_date);
            $totalTriageGreen = $this->ModelDashboard->getTotalTriageGreen($from_date, $to_date);
            $totalPasienPulang = $this->ModelDashboard->getTotalPasienPulang($from_date, $to_date);
            $totalPasienRanap = $this->ModelDashboard->getTotalPasienRanap($from_date, $to_date);
            $totalPasienKhusus = $this->ModelDashboard->getTotalPasienKhusus($from_date, $to_date);

            $tableTotal = "<div class='row'>
                            <div class='col-md-5'>
                                <table class='table' style='width:500px;'>
                                    <tr>
                                        <th colspan='2' class='lightgrey' style='border: 1px solid black;'>Total Pasien Sesuai Triage</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-danger' style='border: 1px solid black;font-size:12px;text-align:center;width:100px;'>Merah</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageRed." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-warning' style='border: 1px solid black;font-size:12px;text-align:center;'>Kuning</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageYellow." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-success' style='border: 1px solid black;font-size:12px;text-align:center;'>Hijau</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageGreen." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-dark' style='border: 1px solid black;font-size:12px;text-align:center;color:#fff;'>Hitam</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageBlack." pasien</th>
                                    </tr>
                                </table>
                            </div>
                            <div class='col-md-6'>
                                <table class='table' style='width:500px;'>
                                    <tr>
                                        <th colspan='2' class='lightgrey' style='border: 1px solid black;'>Total Pasien Pulang dan Rawat Inap</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;width:180px;'>Total Pasien Pulang</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienPulang." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Rawat Inap</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienRanap." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Khusus</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienKhusus." pasien</th>
                                    </tr>
                                </table>
                            </div>
                           </div>";

            echo $tableTotal."".$listReport;
        } else if ($report_type == "1") {
            $listReport = "
                           <table class='table'>
                            <thead>
                            <tr>
                                <th colspan='11' style='border-bottom: 1px solid black;border-top:none;'>
                                    IGD Timestamp Report ".date_indo($from_date)." - ".date_indo($to_date)."
                                </th>
                                <th style='float:right;border-top:none;'>
                                    <a class='btn btn-sm btn-secondary' style='font-size:12px;' href='".base_url()."report/downloadreport/".$from_date."/".$to_date."/1'>Download Excel</button>
                                </th>
                            </tr>
                            <tr style='text-align:center;'>
                                <th class='lightgrey' style='border: 1px solid black;width:50px;'>No.</th>
                                <th class='lightgrey' style='border: 1px solid black;width:100px;'>No. RM</th>
                                <th class='lightgrey' style='border: 1px solid black;width:200px;'>Nama</th>
                                <th class='lightgrey' style='border: 1px solid black;width:120px;'>Pasien Datang <br>s/d<br> Triage</th>
                                <th class='papayawhip' style='border: 1px solid black;width:120px;'>Pasien Triage <br>s/d<br> Pemeriksaan Dr.</th>
                                <th class='papayawhip' style='border: 1px solid black;width:120px;'>Pemeriksaan Dr. <br>s/d<br> Pemeriksaan DPJP</th>
                                <th class='lightpink' style='border: 1px solid black;width:120px;'>Pemeriksaan DPJP <br>s/d<br> Observasi Mulai</th>
                                <th class='lightblue' style='border: 1px solid black;width:110px;'>Observasi Mulai <br>s/d<br> Observasi Selesai</th>
                                <th class='lightblue' style='border: 1px solid black;width:110px;'>Observasi Selesai <br>s/d<br> Pasien Pulang</th>
                                <th class='lightblue' style='border: 1px solid black;width:110px;'>Observasi Selesai <br>s/d<br> Rawat Inap</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Total Waktu</th>
                                <th class='zephyrgreen' style='border: 1px solid black;width:120px;'>Catatan</th>
                            </tr>
                            </thead>
                            <tbody>";

            $getData = $this->ModelDashboard->getDataTimeReport($from_date, $to_date);
            if ($getData !== false) {
            $no = 0;
            foreach ($getData as $row) {
                $no++;

                if (strlen($row->patient_mr) == "1" || strlen($row->patient_mr) == 1) {
                    $patient_mr = "".$prefmr."-0000000".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "2" || strlen($row->patient_mr) == 2) {
                    $patient_mr = "".$prefmr."-000000".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "3" || strlen($row->patient_mr) == 3) {
                    $patient_mr = "".$prefmr."-00000".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "4" || strlen($row->patient_mr) == 4) {
                    $patient_mr = "".$prefmr."-0000".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "5" || strlen($row->patient_mr) == 5) {
                    $patient_mr = "".$prefmr."-000".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "6" || strlen($row->patient_mr) == 6) {
                    $patient_mr = "".$prefmr."-00".$row->patient_mr;
                } else if (strlen($row->patient_mr) == "7" || strlen($row->patient_mr) == 7) {
                    $patient_mr = "".$prefmr."-0".$row->patient_mr;
                } else {
                    $patient_mr = "".$prefmr."-".$row->patient_mr;
                }

                $come_triage_time = $row->come_triage_time;
                if ($come_triage_time == '-838:59:59') {
                    $come_triage_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $come_triage_time_exp = explode(":", $come_triage_time);
                    // $come_triage_time_hour = $come_triage_time_exp[0];
                    // $come_triage_time_minute = $come_triage_time_exp[1];
                    // $come_triage_time_second = $come_triage_time_exp[2];

                    // if ($come_triage_time_hour == '00') {
                    //     $come_triage_time_display = $come_triage_time_minute."m ".$come_triage_time_second."s";
                    // } else {
                    //     $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                    // }
                } else {
                    $come_triage_time_display = $row->come_triage_time;

                    // $come_triage_time_exp = explode(":", $come_triage_time);
                    // $come_triage_time_hour = $come_triage_time_exp[0];
                    // $come_triage_time_minute = $come_triage_time_exp[1];
                    // $come_triage_time_second = $come_triage_time_exp[2];

                    // if ($come_triage_time_hour == '00') {
                    //     $come_triage_time_display = $come_triage_time_minute."m ".$come_triage_time_second."s";
                    // } else {
                    //     $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                    // }
                }

                $triage_checkup_time = $row->triage_checkup_time;
                if ($triage_checkup_time == '-838:59:59') {
                    $triage_checkup_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $triage_checkup_time_exp = explode(":", $triage_checkup_time);
                    // $triage_checkup_time_hour = $triage_checkup_time_exp[0];
                    // $triage_checkup_time_minute = $triage_checkup_time_exp[1];
                    // $triage_checkup_time_second = $triage_checkup_time_exp[2];

                    // if ($triage_checkup_time_hour == '00') {
                    //     $triage_checkup_time_display = $triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                    // } else {
                    //     $triage_checkup_time_display = $triage_checkup_time_hour."h ".$triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                    // }
                } else {
                    $triage_checkup_time_display = $row->triage_checkup_time;

                    // $triage_checkup_time_exp = explode(":", $triage_checkup_time);
                    // $triage_checkup_time_hour = $triage_checkup_time_exp[0];
                    // $triage_checkup_time_minute = $triage_checkup_time_exp[1];
                    // $triage_checkup_time_second = $triage_checkup_time_exp[2];

                    // if ($triage_checkup_time_hour == '00') {
                    //     $triage_checkup_time_display = $triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                    // } else {
                    //     $triage_checkup_time_display = $triage_checkup_time_hour."h ".$triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                    // }
                }

                $checkup_checkupdpjp_time = $row->checkup_checkupdpjp_time;
                if ($checkup_checkupdpjp_time == '-838:59:59') {
                    $checkup_checkupdpjp_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $checkup_checkupdpjp_time_exp = explode(":", $checkup_checkupdpjp_time);
                    // $checkup_checkupdpjp_time_hour = $checkup_checkupdpjp_time_exp[0];
                    // $checkup_checkupdpjp_time_minute = $checkup_checkupdpjp_time_exp[1];
                    // $checkup_checkupdpjp_time_second = $checkup_checkupdpjp_time_exp[2];

                    // if ($checkup_checkupdpjp_time_hour == '00') {
                    //     $checkup_checkupdpjp_time_display = $checkup_checkupdpjp_time_minute."m ".$checkup_checkupdpjp_time_second."s";
                    // } else {
                    //     $checkup_checkupdpjp_time_display = $checkup_checkupdpjp_time_hour."h ".$checkup_checkupdpjp_time_minute."m ".$checkup_checkupdpjp_time_second."s";
                    // }
                } else {
                    $checkup_checkupdpjp_time_display = $row->checkup_checkupdpjp_time;

                    // $checkup_checkupdpjp_time_exp = explode(":", $checkup_checkupdpjp_time);
                    // $checkup_checkupdpjp_time_hour = $checkup_checkupdpjp_time_exp[0];
                    // $checkup_checkupdpjp_time_minute = $checkup_checkupdpjp_time_exp[1];
                    // $checkup_checkupdpjp_time_second = $checkup_checkupdpjp_time_exp[2];

                    // if ($checkup_checkupdpjp_time_hour == '00') {
                    //     $checkup_checkupdpjp_time_display = $checkup_checkupdpjp_time_minute."m ".$checkup_checkupdpjp_time_second."s";
                    // } else {
                    //     $checkup_checkupdpjp_time_display = $checkup_checkupdpjp_time_hour."h ".$checkup_checkupdpjp_time_minute."m ".$checkup_checkupdpjp_time_second."s";
                    // }
                }

                $checkupdpjp_obstart_time = $row->checkupdpjp_obstart_time;
                if ($checkupdpjp_obstart_time == '-838:59:59' || $checkupdpjp_obstart_time == '838:59:59') {
                    $checkupdpjp_obstart_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $checkupdpjp_obstart_time_exp = explode(":", $checkupdpjp_obstart_time);
                    // $checkupdpjp_obstart_time_hour = $checkupdpjp_obstart_time_exp[0];
                    // $checkupdpjp_obstart_time_minute = $checkupdpjp_obstart_time_exp[1];
                    // $checkupdpjp_obstart_time_second = $checkupdpjp_obstart_time_exp[2];

                    // if ($checkupdpjp_obstart_time_hour == '00') {
                    //     $checkupdpjp_obstart_time_display = $checkupdpjp_obstart_time_minute."m ".$checkupdpjp_obstart_time_second."s";
                    // } else {
                    //     $checkupdpjp_obstart_time_display = $checkupdpjp_obstart_time_hour."h ".$checkupdpjp_obstart_time_minute."m ".$checkupdpjp_obstart_time_second."s";
                    // }
                } else {
                    $checkupdpjp_obstart_time_display = $row->checkupdpjp_obstart_time;

                    // $checkupdpjp_obstart_time_exp = explode(":", $checkupdpjp_obstart_time);
                    // $checkupdpjp_obstart_time_hour = $checkupdpjp_obstart_time_exp[0];
                    // $checkupdpjp_obstart_time_minute = $checkupdpjp_obstart_time_exp[1];
                    // $checkupdpjp_obstart_time_second = $checkupdpjp_obstart_time_exp[2];

                    // if ($checkupdpjp_obstart_time_hour == '00') {
                    //     $checkupdpjp_obstart_time_display = $checkupdpjp_obstart_time_minute."m ".$checkupdpjp_obstart_time_second."s";
                    // } else {
                    //     $checkupdpjp_obstart_time_display = $checkupdpjp_obstart_time_hour."h ".$checkupdpjp_obstart_time_minute."m ".$checkupdpjp_obstart_time_second."s";
                    // }
                }

                $obstart_obfinish_time = $row->obstart_obfinish_time;
                if ($obstart_obfinish_time == '-838:59:59') {
                    $obstart_obfinish_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $obstart_obfinish_time_exp = explode(":", $obstart_obfinish_time);
                    // $obstart_obfinish_time_hour = $obstart_obfinish_time_exp[0];
                    // $obstart_obfinish_time_minute = $obstart_obfinish_time_exp[1];
                    // $obstart_obfinish_time_second = $obstart_obfinish_time_exp[2];

                    // if ($obstart_obfinish_time_hour == '00') {
                    //     $obstart_obfinish_time_display = $obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                    // } else {
                    //     $obstart_obfinish_time_display = $obstart_obfinish_time_hour."h ".$obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                    // }
                } else {
                    $obstart_obfinish_time_display = $row->obstart_obfinish_time;

                    // $obstart_obfinish_time_exp = explode(":", $obstart_obfinish_time);
                    // $obstart_obfinish_time_hour = $obstart_obfinish_time_exp[0];
                    // $obstart_obfinish_time_minute = $obstart_obfinish_time_exp[1];
                    // $obstart_obfinish_time_second = $obstart_obfinish_time_exp[2];

                    // if ($obstart_obfinish_time_hour == '00') {
                    //     $obstart_obfinish_time_display = $obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                    // } else {
                    //     $obstart_obfinish_time_display = $obstart_obfinish_time_hour."h ".$obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                    // }
                }

                $obfinish_obgo_time = $row->obfinish_obgo_time;
                if ($obfinish_obgo_time == '-838:59:59') {
                    $obfinish_obgo_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $obfinish_obgo_time_exp = explode(":", $obfinish_obgo_time);
                    // $obfinish_obgo_time_hour = $obfinish_obgo_time_exp[0];
                    // $obfinish_obgo_time_minute = $obfinish_obgo_time_exp[1];
                    // $obfinish_obgo_time_second = $obfinish_obgo_time_exp[2];

                    // $obfinish_obgo_time_display = "";
                } else {
                    $obfinish_obgo_time_display = $row->obfinish_obgo_time;

                    // $obfinish_obgo_time_exp = explode(":", $obfinish_obgo_time);
                    // $obfinish_obgo_time_hour = $obfinish_obgo_time_exp[0];
                    // $obfinish_obgo_time_minute = $obfinish_obgo_time_exp[1];
                    // $obfinish_obgo_time_second = $obfinish_obgo_time_exp[2];

                    // if ($obfinish_obgo_time_hour == '00') {
                    //     $obfinish_obgo_time_display = $obfinish_obgo_time_minute."m ".$obfinish_obgo_time_second."s";
                    // } else {
                    //     $obfinish_obgo_time_display = $obfinish_obgo_time_hour."h ".$obfinish_obgo_time_minute."m ".$obfinish_obgo_time_second."s";
                    // }
                }

                $obfinish_obtransfer_time = $row->obfinish_obtransfer_time;
                if ($obfinish_obtransfer_time == '-838:59:59') {
                    $obfinish_obtransfer_time_display = date('H:i:s', strtotime('00:00:00'));

                    // $obfinish_obtransfer_time_exp = explode(":", $obfinish_obtransfer_time);
                    // $obfinish_obtransfer_time_hour = $obfinish_obtransfer_time_exp[0];
                    // $obfinish_obtransfer_time_minute = $obfinish_obtransfer_time_exp[1];
                    // $obfinish_obtransfer_time_second = $obfinish_obtransfer_time_exp[2];

                    // $obfinish_obtransfer_time_display = "";
                } else {
                    $obfinish_obtransfer_time_display = $row->obfinish_obtransfer_time;

                    // $obfinish_obtransfer_time_exp = explode(":", $obfinish_obtransfer_time);
                    // $obfinish_obtransfer_time_hour = $obfinish_obtransfer_time_exp[0];
                    // $obfinish_obtransfer_time_minute = $obfinish_obtransfer_time_exp[1];
                    // $obfinish_obtransfer_time_second = $obfinish_obtransfer_time_exp[2];

                    // if ($obfinish_obtransfer_time_hour == '00') {
                    //     $obfinish_obtransfer_time_display = $obfinish_obtransfer_time_minute."m ".$obfinish_obtransfer_time_second."s";
                    // } else {
                    //     $obfinish_obtransfer_time_display = $obfinish_obtransfer_time_hour."h ".$obfinish_obtransfer_time_minute."m ".$obfinish_obtransfer_time_second."s";
                    // }
                }
            
                // echo $obfinish_obtransfer_time_display;

                $dash = "-";
                // if (preg_match("/$dash/i", $come_triage_time)) {
                //     $bgcolor_come_triage_time = "bg-danger";
                // } else {
                //     $bgcolor_come_triage_time = "";
                // }

                // if (preg_match("/$dash/i", $triage_checkup_time)) {
                //     $bgcolor_triage_checkup_time = "bg-danger";
                // } else {
                //     $bgcolor_triage_checkup_time = "";
                // }

                // if (preg_match("/$dash/i", $checkup_checkupdpjp_time)) {
                //     $bgcolor_checkup_checkupdpjp_time = "bg-danger";
                // } else {
                //     $bgcolor_checkup_checkupdpjp_time = "";
                // }

                // if (preg_match("/$dash/i", $checkupdpjp_obstart_time)) {
                //     $bgcolor_checkupdpjp_obstart_time = "bg-danger";
                // } else {
                //     $bgcolor_checkupdpjp_obstart_time = "";
                // }

                // if (preg_match("/$dash/i", $obstart_obfinish_time)) {
                //     $bgcolor_obstart_obfinish_time = "bg-danger";
                // } else {
                //     $bgcolor_obstart_obfinish_time = "";
                // }

                // if (preg_match("/$dash/i", $obfinish_obgo_time)) {
                //     $bgcolor_obfinish_obgo_time = "bg-danger";
                // } else {
                //     $bgcolor_obfinish_obgo_time = "";
                // }

                // if (preg_match("/$dash/i", $obfinish_obtransfer_time)) {
                //     $bgcolor_obfinish_obtransfer_time = "bg-danger";
                // } else {
                //     $bgcolor_obfinish_obtransfer_time = "";
                // }

                // $time = [
                //     $come_triage_time, $triage_checkup_time, $checkup_checkupdpjp_time, $checkupdpjp_obstart_time, $obstart_obfinish_time, $obfinish_obgo_time, $obfinish_obtransfer_time
                // ];

                // $time = [
                //     $come_triage_time_display, $triage_checkup_time_display
                // ];

                // $total = 0;
 
                // foreach($time as $element):
                    
                //     if ($element == "838:59:59") {
                //         continue;
                //     }

                //     $temp = explode(":", $element);
                    
                //     if ((preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1]) || preg_match("/$dash/i", $temp[2])) && ($temp[0] && $temp[1] && $temp[2])) {
                //         $total = $total;
                //     } else {
                //         $total+= (int) $temp[0] * 3600;
                //     }

                //     if (preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1] || preg_match("/$dash/i", $temp[2])) && ($temp[0] && $temp[1] && $temp[2])) {
                //         $total = $total;
                //     } else {
                //         $total+= (int) $temp[1] * 60;
                //     }

                //     if (preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1] || preg_match("/$dash/i", $temp[2])) && ($temp[0] && $temp[1] && $temp[2])) {
                //         $total = $total;
                //     } else {
                //         $total+= (int) $temp[2];
                //     }

                // endforeach;
                // // if (($total / 3600) >= '1') {
                //     $total_waktu = sprintf('%02dh %02dm %02ds', ($total / 3600), ($total / 60 % 60), $total % 60);
                // // } else {
                // //     $total_waktu = sprintf('%02dm %02ds', ($total / 60 % 60), $total % 60);
                // // }

                // echo $total_waktu;

                
                // $total_waktux = sprintf('%02d %02d %02d', ($total / 3600), ($total / 60 % 60), $total % 60);
                // $total_waktu_exp = explode(" ", $total_waktux);
                // $getNotes = $this->ModelDashboard->getNotes($row->time_stamp_id);

                // if ($getNotes != false) {
                //     foreach ($getNotes as $rowNotes) {
                //         $notes_id = $rowNotes->id;
                //         $notes = $rowNotes->notes;
                //     }
                // } else {

                // }

                // if ($notes == "" && $row->patient_khusus == "1") {
                //     if ($total_waktu_exp[0] >= 04) {
                //         $kolom_keterangan = "<div style='float:left;text-align:left;'>
                //                                 <textarea id='notes_".$row->time_stamp_id."'></textarea>
                //                                 <button style='margin-top:1px;' onclick='saveNotes(\"$row->time_stamp_id\")'>Simpan Keterangan</button>
                //                              </div>";
                //     } else {
                //         $kolom_keterangan = "";
                //     }

                //     $catatan = "<div style='text-align:left;'>
                //                     <ul style='padding-left:15px;'>
                //                         <li>Pasien Khusus</li>
                //                         <br>
                //                         ".$kolom_keterangan."
                //                     </ul>
                //                 </div>";
                // } else if ($notes != "" && $row->patient_khusus == "") {
                //     $catatan = "<div style='text-align:left;' id='row-notes-".$notes_id."'>
                //                     <ul style='padding-left:15px;'>
                //                         <li><b>Catatan Khusus: </b>".$notes."</li>
                //                         <a href='#' onclick='editNotes(\"$notes_id\")'>Edit catatan</a>
                //                     </ul>
                //                 </div>";
                // } else if ($notes != "" && $row->patient_khusus == "1") {
                //     $catatan = "<div style='text-align:left;' id='row-notes-".$notes_id."'>
                //                     <ul style='padding-left:15px;'>
                //                         <li>Pasien Khusus</li>
                //                         <li><b>Catatan Khusus: </b>".$notes."</li>
                //                         <a href='#' onclick='editNotes(\"$notes_id\")'>Edit catatan</a>
                //                     </ul>
                //                 </div>";
                // } else if ($notes == "" && $row->patient_khusus == "") {
                //     if ($total_waktu_exp[0] >= 04) {
                //         $catatan = "<div style='text-align:left;'>
                //                         <ul style='padding-left:15px;'>
                //                             <div style='float:left;text-align:left;'>
                //                                 <textarea id='notes_".$row->time_stamp_id."'></textarea>
                //                                 <button style='margin-top:1px;' onclick='saveNotes(\"$row->time_stamp_id\")'>Simpan Keterangan</button>
                //                             </div>
                //                         </ul>
                //                     </div>";
                //     } else {
                //         $catatan = "";
                //     }
                // }

                // $total  = strtotime($come_triage_time_display);

                // // $totall = strtotime(time, $total);
                // $totall = strtotime(date("H:i:s"), $total);

                // echo $totall."<br>";

                $listReport .= "<tr style='font-size:11px;'>
                                    <td style='border: 1px solid black;'>".$no.".</td>
                                    <td style='border: 1px solid black;'>".$patient_mr."</td>
                                    <td style='border: 1px solid black;'>".$row->patient_name."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$come_triage_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$triage_checkup_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$checkup_checkupdpjp_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$checkupdpjp_obstart_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$obstart_obfinish_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$obfinish_obgo_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'>".$obfinish_obtransfer_time_display."</td>
                                    <td style='border: 1px solid black;text-align:center;'><b></b></td>
                                    <td style='border: 1px solid black;'></td>
                                </tr>
                                <script>
                                    function saveNotes(ts_id) {
                                        var notes = $('#notes_'+ts_id).val();
                                        $.ajax({
                                            type: 'post',
                                            url: '".base_url()."report/savenotes',
                                            data: {ts_id:ts_id, notes:notes},
                                            success: function (data) {
                                                getReport();
                                            }
                                        });
                                    }

                                    function editNotes(notes_id) {
                                        $.ajax({
                                            type: 'post',
                                            url: '".base_url()."report/showeditnotes',
                                            data: {notes_id:notes_id},
                                            success: function (data) {
                                                $('#row-notes-'+notes_id).html(data);
                                            }
                                        });
                                    }
                                </script>";
            }
            } else {
                $listReport .= "<tr><td colspan='11' class='bg-danger' align='center' style='border:1px solid black;color:#fff;'>Tidak ada data</td></tr>";
            }

            $listReport .= "</tbody></table>";

            $totalTriageBlack = $this->ModelDashboard->getTotalTriageBlack($from_date, $to_date);
            $totalTriageRed = $this->ModelDashboard->getTotalTriageRed($from_date, $to_date);
            $totalTriageYellow = $this->ModelDashboard->getTotalTriageYellow($from_date, $to_date);
            $totalTriageGreen = $this->ModelDashboard->getTotalTriageGreen($from_date, $to_date);
            $totalPasienPulang = $this->ModelDashboard->getTotalPasienPulang($from_date, $to_date);
            $totalPasienRanap = $this->ModelDashboard->getTotalPasienRanap($from_date, $to_date);
            $totalPasienKhusus = $this->ModelDashboard->getTotalPasienKhusus($from_date, $to_date);

            $tableTotal = "<div class='row'>
                            <div class='col-md-5'>
                                <table class='table' style='width:500px;'>
                                    <tr>
                                        <th colspan='2' class='lightgrey' style='border: 1px solid black;'>Total Pasien Sesuai Triage</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-danger' style='border: 1px solid black;font-size:12px;text-align:center;width:100px;'>Merah</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageRed." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-warning' style='border: 1px solid black;font-size:12px;text-align:center;'>Kuning</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageYellow." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-success' style='border: 1px solid black;font-size:12px;text-align:center;'>Hijau</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageGreen." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-dark' style='border: 1px solid black;font-size:12px;text-align:center;color:#fff;'>Hitam</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalTriageBlack." pasien</th>
                                    </tr>
                                </table>
                            </div>
                            <div class='col-md-6'>
                                <table class='table' style='width:500px;'>
                                    <tr>
                                        <th colspan='2' class='lightgrey' style='border: 1px solid black;'>Total Pasien Pulang dan Rawat Inap</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;width:180px;'>Total Pasien Pulang</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienPulang." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Rawat Inap</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienRanap." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Khusus</th>
                                        <th style='border: 1px solid black;font-size:12px;'>".$totalPasienKhusus." pasien</th>
                                    </tr>
                                </table>
                            </div>
                        </div>";

            echo $tableTotal."".$listReport;
        } else {
            $data = "<div class='table table-responsive'>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th class='lightgrey' style='border: 1px solid black;width:20px;'>No.</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Nama Pasien</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Nomor Rekam Medis</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Tanggal Lahir</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Jenis Kelamin</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Tekanan Darah Sistolik</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Tekanan Darah Diastolik</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Respirasi</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Saturasi</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Nadi</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Suhu</th>
                                    <th class='lightgrey' style='border: 1px solid black;'>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>";

            $no = 0;
            $dataReport = $this->ModelDashboard->getDataTtvReport($from_date, $to_date);
            if ($dataReport != false) {
                foreach ($dataReport as $row) {
                    $no++;

                    if ($row->patient_gender == "0") {
                        $patient_gender = "Laki-laki";
                    } else {
                        $patient_gender = "Perempuan";
                    }

                    if ($row->patient_notes == "kembali_ke_fktp") {
                        $patient_notes = "Kembali ke Faskes Tingkat 1";
                    } else if ($row->patient_notes == "berobat_ke_poli") {
                        $patient_notes = "Berobat ke Poli";
                    } else if ($row->patient_notes == "batal_berobat") {
                        $patient_notes = "Batal Berobat";
                    } else {
                        $patient_notes = $row->patient_notes;
                    }

                    $data .= "<tr style='font-size:11px;'>
                                <td style='border: 1px solid black;'>".$no.".</td>
                                <td style='border: 1px solid black;'>".$row->patient_name."</td>
                                <td style='border: 1px solid black;'>".$row->patient_mr."</td>
                                <td style='border: 1px solid black;'>".date_indo($row->patient_dob)."</td>
                                <td style='border: 1px solid black;'>".$patient_gender."</td>
                                <td style='border: 1px solid black;'>".$row->tekanan_darah_sistolik."</td>
                                <td style='border: 1px solid black;'>".$row->tekanan_darah_diastolik."</td>
                                <td style='border: 1px solid black;'>".$row->respirasi."</td>
                                <td style='border: 1px solid black;'>".$row->saturasi."</td>
                                <td style='border: 1px solid black;'>".$row->nadi."</td>
                                <td style='border: 1px solid black;'>".$row->suhu."</td>
                                <td style='border: 1px solid black;'>".$patient_notes."</td>
                              </tr>";
                }
            }

            $data .= "<tbody></table></div>";

            echo $data;
        }
	}

    public function showEditNotes() {
        $notes_id = $this->input->post("notes_id");

        $getNotesByID = $this->ModelDashboard->getNotesByID($notes_id);
        if ($getNotesByID != false) {
            foreach ($getNotesByID as $row) {
                $notes_id = $row->id;
                $time_stamp_id = $row->time_stamp_id;
                $notes = $row->notes;
                $patient_khusus = $row->patient_khusus;
            }

            if ($patient_khusus == "") {
                echo "<div style='text-align:left;'>
                        <ul style='padding-left:15px;'>
                            <div style='float:left;text-align:left;'>
                                <textarea id='notes_".$notes_id."'>".$notes."</textarea>
                                <button style='margin-top:1px;' onclick='saveEditNotes(\"$notes_id\")'>Simpan</button>
                                <button style='margin-top:1px;' onclick='cancelEdit()'>Batal</button>
                            </div>
                        </ul>
                      </div>
                      <script>
                        function saveEditNotes(notes_id) {
                            var notes = $('#notes_'+notes_id).val();
                            $.ajax({
                                type: 'post',
                                url: '".base_url()."report/saveeditnotes',
                                data: {notes_id:notes_id, notes:notes},
                                success: function (data) {
                                    getReport();
                                }
                            });
                        }
                        function cancelEdit() {
                            getReport();
                        }
                      </script>";
            } else {
                echo "<div style='text-align:left;'>
                        <ul style='padding-left:15px;'>
                            <li>Pasien Khusus</li>
                            <br>
                            <div style='float:left;text-align:left;'>
                                <textarea id='notes_".$notes_id."'>".$notes."</textarea>
                                <button style='margin-top:1px;' onclick='saveEditNotes(\"$notes_id\")'>Simpan</button>
                                <button style='margin-top:1px;' onclick='cancelEdit()'>Batal</button>
                            </div>
                        </ul>
                      </div>
                      <script>
                        function saveEditNotes(notes_id) {
                            var notes = $('#notes_'+notes_id).val();
                            $.ajax({
                                type: 'post',
                                url: '".base_url()."report/saveeditnotes',
                                data: {notes_id:notes_id, notes:notes},
                                success: function (data) {
                                    getReport();
                                }
                            });
                        }
                        function cancelEdit() {
                            getReport();
                        }
                      </script>";
            }
        } else {

        }
    }

    public function saveEditNotes() {
        $notes_id = $this->input->post("notes_id");
        $notes = $this->input->post("notes");

        $saveEditNotes = $this->ModelDashboard->saveEditNotes($notes_id, $notes);
    }

	public function downloadReport() {
        $from_date = $this->uri->segment(3);
		$to_date = $this->uri->segment(4);
		$report_type = $this->uri->segment(5);

        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        
        header("Content-type: application/vnd-ms-excel");    
        header("Content-Disposition: attachment; filename=report_igd_timestamp_".$from_time."_".$to_time.".xls");

        if ($report_type == "0") {

            $prefmr = "01";

            $data['listReport'] = "<table class='table'>
                                <thead>
                                <tr>
                                    <th colspan='17' style='border-bottom: 1px solid black;border-top:none;'>
                                        IGD Timestamp Report ".date_indo($from_date)." - ".date_indo($to_date)."
                                    </th>
                                </tr>
                                <tr style='text-align:center;'>
                                    <th rowspan='2' class='lightgrey' style='border: 1px solid black;'>No.</th>
                                    <th rowspan='2' class='lightgrey' style='border: 1px solid black;'>No. RM</th>
                                    <th rowspan='2' class='lightgrey' style='border: 1px solid black;'>Nama</th>
                                    <th colspan='2' class='peachpuff' style='border: 1px solid black;'>Pasien Datang</th>
                                    <th colspan='2' class='papayawhip' style='border: 1px solid black;'>Triage</th>
                                    <th colspan='2' class='lightpink' style='border: 1px solid black;'>Pemeriksaan Dr.</th>
                                    <th colspan='2' class='lightblue' style='border: 1px solid black;'>Observasi/Tindakan Mulai</th>
                                    <th colspan='2' class='lightblue' style='border: 1px solid black;'>Observasi/Tindakan Selesai</th>
                                    <th colspan='2' class='pastelmint' style='border: 1px solid black;'>Pasien Pulang</th>
                                    <th colspan='2' class='zephyrgreen' style='border: 1px solid black;'>Pasien Transfer Rawat Inap</th>
                                </tr>
                                <tr style='text-align:center;'>
                                    <th class='peachpuff' style='border: 1px solid black;'>Hari</th>
                                    <th class='peachpuff' style='border: 1px solid black;'>Jam</th>
                                    <th class='papayawhip' style='border: 1px solid black;'>Hari</th>
                                    <th class='papayawhip' style='border: 1px solid black;'>Jam</th>
                                    <th class='lightpink' style='border: 1px solid black;'>Hari</th>
                                    <th class='lightpink' style='border: 1px solid black;'>Jam</th>
                                    <th class='lightblue' style='border: 1px solid black;'>Hari</th>
                                    <th class='lightblue' style='border: 1px solid black;'>Jam</th>
                                    <th class='lightblue' style='border: 1px solid black;'>Hari</th>
                                    <th class='lightblue' style='border: 1px solid black;'>Jam</th>
                                    <th class='pastelmint' style='border: 1px solid black;'>Hari</th>
                                    <th class='pastelmint' style='border: 1px solid black;'>Jam</th>
                                    <th class='zephyrgreen' style='border: 1px solid black;'>Hari</th>
                                    <th class='zephyrgreen' style='border: 1px solid black;'>Jam</th>
                                </tr>
                               </thead>
                               <tbody>";

            $getData = $this->ModelDashboard->getDataReport($from_date, $to_date);
            if ($getData !== false) {
                $no = 0;
                foreach ($getData as $row) {
                    $no++;
                    

                    if (strlen($row->patient_mr) == "1" || strlen($row->patient_mr) == 1) {
                        $patient_mr = "".$prefmr."-0000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "2" || strlen($row->patient_mr) == 2) {
                        $patient_mr = "".$prefmr."-000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "3" || strlen($row->patient_mr) == 3) {
                        $patient_mr = "".$prefmr."-00000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "4" || strlen($row->patient_mr) == 4) {
                        $patient_mr = "".$prefmr."-0000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "5" || strlen($row->patient_mr) == 5) {
                        $patient_mr = "".$prefmr."-000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "6" || strlen($row->patient_mr) == 6) {
                        $patient_mr = "".$prefmr."-00".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "7" || strlen($row->patient_mr) == 7) {
                        $patient_mr = "".$prefmr."-0".$row->patient_mr;
                    } else {
                        $patient_mr = "".$prefmr."-".$row->patient_mr;
                    }

                    if ($row->patient_come == "0000-00-00 00:00:00") {
                        $patient_come_date = "";
                        $patient_come_time = "";
                    } else {
                        $patient_come = explode(" ", $row->patient_come);
                        $patient_come_date = date_indo($patient_come[0]);
                        $patient_come_time = $patient_come[1];
                    }

                    if ($row->patient_triage == "0000-00-00 00:00:00") {
                        $patient_triage_date = "";
                        $patient_triage_time = "";
                        $bgtriage = "";
                    } else {
                        if ($row->triage_color == "red") {
                            $bgtriage = "bg-danger";
                            $color = "color:#000;";
                        } else if ($row->triage_color == "green") {
                            $bgtriage = "bg-success";
                            $color = "color:#000;";
                        } else if ($row->triage_color == "yellow") {
                            $bgtriage = "bg-warning";
                            $color = "color:#000;";
                        } else {
                            $bgtriage = "bg-dark";
                            $color = "color:#fff;";
                        }

                        $patient_triage = explode(" ", $row->patient_triage);
                        $patient_triage_date = date_indo($patient_triage[0]);
                        $patient_triage_time = $patient_triage[1];
                    }

                    if ($row->patient_checkup == "0000-00-00 00:00:00") {
                        $patient_checkup_date = "";
                        $patient_checkup_time = "";
                    } else {
                        $patient_checkup = explode(" ", $row->patient_checkup);
                        $patient_checkup_date = date_indo($patient_checkup[0]);
                        $patient_checkup_time = $patient_checkup[1];
                    }

                    if ($row->patient_observation_start == "0000-00-00 00:00:00") {
                        $patient_obstart_date = "";
                        $patient_obstart_time = "";
                    } else {
                        $patient_observation_start = explode(" ", $row->patient_observation_start);
                        $patient_obstart_date = date_indo($patient_observation_start[0]);
                        $patient_obstart_time = $patient_observation_start[1];
                    }

                    if ($row->patient_observation_finish == "0000-00-00 00:00:00") {
                        $patient_obfinish_date = "";
                        $patient_obfinish_time = "";
                    } else {
                        $patient_observation_finish = explode(" ", $row->patient_observation_finish);
                        $patient_obfinish_date = date_indo($patient_observation_finish[0]);
                        $patient_obfinish_time = $patient_observation_finish[1];
                    }

                    if ($row->patient_go == "0000-00-00 00:00:00") {
                        $patient_go_date = "";
                        $patient_go_time = "";
                    } else {
                        $patient_go = explode(" ", $row->patient_go);
                        $patient_go_date = date_indo($patient_go[0]);
                        $patient_go_time = $patient_go[1];
                    }

                    if ($row->patient_transfer == "0000-00-00 00:00:00") {
                        $patient_transfer_date = "";
                        $patient_transfer_time = "";
                    } else {
                        $patient_transfer = explode(" ", $row->patient_transfer);
                        $patient_transfer_date = date_indo($patient_transfer[0]);
                        $patient_transfer_time = $patient_transfer[1];
                    }

                    $data['listReport'] .= "<tr style='font-size:11px;'>
                                                <td style='border: 1px solid black;'>".$no.".</td>
                                                <td style='border: 1px solid black;'>".$patient_mr."</td>
                                                <td style='border: 1px solid black;'>".$row->patient_name."</td>
                                                <td style='border: 1px solid black;'>".$patient_come_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_come_time."</td>
                                                <td style='border: 1px solid black;' class='".$bgtriage."'>".$patient_triage_date."</td>
                                                <td style='border: 1px solid black;' class='".$bgtriage."'>".$patient_triage_time."</td>
                                                <td style='border: 1px solid black;'>".$patient_checkup_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_checkup_time."</td>
                                                <td style='border: 1px solid black;'>".$patient_obstart_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_obstart_time."</td>
                                                <td style='border: 1px solid black;'>".$patient_obfinish_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_obfinish_time."</td>
                                                <td style='border: 1px solid black;'>".$patient_go_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_go_time."</td>
                                                <td style='border: 1px solid black;'>".$patient_transfer_date."</td>
                                                <td style='border: 1px solid black;'>".$patient_transfer_time."</td>
                                            </tr>";
                }
            } else {
                $data['listReport'] .= "<tr><td colspan='11' class='bg-danger' align='center' style='border:1px solid black;color:#fff;'>Tidak ada data</td></tr>";
            }

            $data['listReport'] .= "</tbody></table>";

            $totalTriageBlack = $this->ModelDashboard->getTotalTriageBlack($from_date, $to_date);
            $totalTriageRed = $this->ModelDashboard->getTotalTriageRed($from_date, $to_date);
            $totalTriageYellow = $this->ModelDashboard->getTotalTriageYellow($from_date, $to_date);
            $totalTriageGreen = $this->ModelDashboard->getTotalTriageGreen($from_date, $to_date);
            $totalPasienPulang = $this->ModelDashboard->getTotalPasienPulang($from_date, $to_date);
            $totalPasienRanap = $this->ModelDashboard->getTotalPasienRanap($from_date, $to_date);
            $totalPasienKhusus = $this->ModelDashboard->getTotalPasienKhusus($from_date, $to_date);

            $data['tableTotal'] = "<table class='table' style='width:900px;'>
                                    <tr>
                                        <th colspan='4' class='lightgrey' style='border: 1px solid black;'>Total Pasien Sesuai Triage</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-danger' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;width:100px;'>Merah</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageRed." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-warning' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Kuning</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageYellow." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-success' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Hijau</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageGreen." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-dark' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;color:#fff;'>Hitam</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageBlack." pasien</th>
                                    </tr>
                                </table>
                                
                                <table class='table' style='width:900px;'>
                                    <tr>
                                        <th colspan='3' class='lightgrey' style='border: 1px solid black;'>Total Pasien Pulang, Pasien Rawat Inap dan Pasien Khusus</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;width:180px;'>Total Pasien Pulang</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienPulang." pasien</th>
                                    </tr>
                                    <tr>
                                        <th  class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Rawat Inap</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienRanap." pasien</th>
                                    </tr>
                                    <tr>
                                        <th  class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Khusus</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienKhusus." pasien</th>
                                    </tr>
                                </table>";
        } else {

            $prefmr = "01";

            $data['listReport'] = "<table class='table'>
                                    <thead>
                                    <tr>
                                        <th colspan='10' style='border-bottom: 1px solid black;border-top:none;'>
                                            IGD Timestamp Report ".date_indo($from_date)." - ".date_indo($to_date)."
                                        </th>
                                    </tr>
                                    <tr style='text-align:center;'>
                                        <th class='lightgrey' style='border: 1px solid black;'>No.</th>
                                        <th class='lightgrey' style='border: 1px solid black;'>No. RM</th>
                                        <th class='lightgrey' style='border: 1px solid black;'>Nama</th>
                                        <th class='lightgrey' style='border: 1px solid black;width:250px;'>Pasien Datang <br>s/d<br> Triage</th>
                                        <th class='papayawhip' style='border: 1px solid black'>Pasien Triage <br>s/d<br> Pemeriksaan Dr.</th>
                                        <th class='lightpink' style='border: 1px solid black;'>Pemeriksaan Dr. <br>s/d<br> Observasi Mulai</th>
                                        <th class='lightblue' style='border: 1px solid black;'>Observasi Mulai <br>s/d<br> Observasi Selesai</th>
                                        <th class='lightblue' style='border: 1px solid black;'>Observasi Selesai <br>s/d<br> Pasien Pulang</th>
                                        <th class='lightblue' style='border: 1px solid black;'>Observasi Selesai <br>s/d<br> Rawat Inap</th>
                                        <th class='zephyrgreen' style='border: 1px solid black;'>Total Waktu</th>
                                        <th class='zephyrgreen' style='border: 1px solid black;'>Pasien Khusus</th>
                                    </tr>
                                    </thead>
                                    <tbody>";

            $getData = $this->ModelDashboard->getDataTimeReport($from_date, $to_date);
            if ($getData !== false) {
                $no = 0;
                foreach ($getData as $row) {
                    $no++;

                    if (strlen($row->patient_mr) == "1" || strlen($row->patient_mr) == 1) {
                        $patient_mr = "".$prefmr."-0000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "2" || strlen($row->patient_mr) == 2) {
                        $patient_mr = "".$prefmr."-000000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "3" || strlen($row->patient_mr) == 3) {
                        $patient_mr = "".$prefmr."-00000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "4" || strlen($row->patient_mr) == 4) {
                        $patient_mr = "".$prefmr."-0000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "5" || strlen($row->patient_mr) == 5) {
                        $patient_mr = "".$prefmr."-000".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "6" || strlen($row->patient_mr) == 6) {
                        $patient_mr = "".$prefmr."-00".$row->patient_mr;
                    } else if (strlen($row->patient_mr) == "7" || strlen($row->patient_mr) == 7) {
                        $patient_mr = "".$prefmr."-0".$row->patient_mr;
                    } else {
                        $patient_mr = "".$prefmr."-".$row->patient_mr;
                    }

                    $dash = "-";
                    $come_triage_time = $row->come_triage_time;
                    if (preg_match("/$dash/i", $come_triage_time)) {

                        if ($come_triage_time == '-838:59:59') {
                            $come_triage_time = date('H:i:s', strtotime('00:00:00'));
    
                            $come_triage_time_exp = explode(":", $come_triage_time);
                            $come_triage_time_hour = $come_triage_time_exp[0];
                            $come_triage_time_minute = $come_triage_time_exp[1];
                            $come_triage_time_second = $come_triage_time_exp[2];
    
                            if ($come_triage_time_hour == '00') {
                                $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                            } else {
                                $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                            }
                        } else {
                            $come_triage_time_exp = explode(":", $come_triage_time);
                            $come_triage_time_hour = $come_triage_time_exp[0];
                            $come_triage_time_minute = $come_triage_time_exp[1];
                            $come_triage_time_second = $come_triage_time_exp[2];
    
                            $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                        }
                    } else {
                        $come_triage_time = $row->come_triage_time;
    
                        $come_triage_time_exp = explode(":", $come_triage_time);
                        $come_triage_time_hour = $come_triage_time_exp[0];
                        $come_triage_time_minute = $come_triage_time_exp[1];
                        $come_triage_time_second = $come_triage_time_exp[2];

                        if ($come_triage_time_hour == '00') {
                            $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                        } else {
                            $come_triage_time_display = $come_triage_time_hour."h ".$come_triage_time_minute."m ".$come_triage_time_second."s";
                        }
                    }
                    

                    $triage_checkup_time = $row->triage_checkup_time;
                    if ($triage_checkup_time == '-838:59:59') {
                        $triage_checkup_time = date('H:i:s', strtotime('00:00:00'));

                        $triage_checkup_time_exp = explode(":", $triage_checkup_time);
                        $triage_checkup_time_hour = $triage_checkup_time_exp[0];
                        $triage_checkup_time_minute = $triage_checkup_time_exp[1];
                        $triage_checkup_time_second = $triage_checkup_time_exp[2];

                        if ($triage_checkup_time_hour == '00') {
                            $triage_checkup_time_display = $triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                        } else {
                            $triage_checkup_time_display = $triage_checkup_time_hour."h ".$triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                        }
                    } else {
                        $triage_checkup_time = $row->triage_checkup_time;

                        $triage_checkup_time_exp = explode(":", $triage_checkup_time);
                        $triage_checkup_time_hour = $triage_checkup_time_exp[0];
                        $triage_checkup_time_minute = $triage_checkup_time_exp[1];
                        $triage_checkup_time_second = $triage_checkup_time_exp[2];

                        if ($triage_checkup_time_hour == '00') {
                            $triage_checkup_time_display = $triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                        } else {
                            $triage_checkup_time_display = $triage_checkup_time_hour."h ".$triage_checkup_time_minute."m ".$triage_checkup_time_second."s";
                        }
                    }

                    $checkup_obstart_time = $row->checkup_obstart_time;
                    if ($checkup_obstart_time == '-838:59:59') {
                        $checkup_obstart_time = date('H:i:s', strtotime('00:00:00'));

                        $checkup_obstart_time_exp = explode(":", $checkup_obstart_time);
                        $checkup_obstart_time_hour = $checkup_obstart_time_exp[0];
                        $checkup_obstart_time_minute = $checkup_obstart_time_exp[1];
                        $checkup_obstart_time_second = $checkup_obstart_time_exp[2];

                        if ($checkup_obstart_time_hour == '00') {
                            $checkup_obstart_time_display = $checkup_obstart_time_minute."m ".$checkup_obstart_time_second."s";
                        } else {
                            $checkup_obstart_time_display = $checkup_obstart_time_hour."h ".$checkup_obstart_time_minute."m ".$checkup_obstart_time_second."s";
                        }
                    } else {
                        $checkup_obstart_time = $row->checkup_obstart_time;

                        $checkup_obstart_time_exp = explode(":", $checkup_obstart_time);
                        $checkup_obstart_time_hour = $checkup_obstart_time_exp[0];
                        $checkup_obstart_time_minute = $checkup_obstart_time_exp[1];
                        $checkup_obstart_time_second = $checkup_obstart_time_exp[2];

                        if ($checkup_obstart_time_hour == '00') {
                            $checkup_obstart_time_display = $checkup_obstart_time_minute."m ".$checkup_obstart_time_second."s";
                        } else {
                            $checkup_obstart_time_display = $checkup_obstart_time_hour."h ".$checkup_obstart_time_minute."m ".$checkup_obstart_time_second."s";
                        }
                    }

                    $obstart_obfinish_time = $row->obstart_obfinish_time;
                    if ($obstart_obfinish_time == '-838:59:59') {
                        $obstart_obfinish_time = date('H:i:s', strtotime('00:00:00'));

                        $obstart_obfinish_time_exp = explode(":", $obstart_obfinish_time);
                        $obstart_obfinish_time_hour = $obstart_obfinish_time_exp[0];
                        $obstart_obfinish_time_minute = $obstart_obfinish_time_exp[1];
                        $obstart_obfinish_time_second = $obstart_obfinish_time_exp[2];

                        if ($obstart_obfinish_time_hour == '00') {
                            $obstart_obfinish_time_display = $obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                        } else {
                            $obstart_obfinish_time_display = $obstart_obfinish_time_hour."h ".$obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                        }
                    } else {
                        $obstart_obfinish_time = $row->obstart_obfinish_time;

                        $obstart_obfinish_time_exp = explode(":", $obstart_obfinish_time);
                        $obstart_obfinish_time_hour = $obstart_obfinish_time_exp[0];
                        $obstart_obfinish_time_minute = $obstart_obfinish_time_exp[1];
                        $obstart_obfinish_time_second = $obstart_obfinish_time_exp[2];

                        if ($obstart_obfinish_time_hour == '00') {
                            $obstart_obfinish_time_display = $obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                        } else {
                            $obstart_obfinish_time_display = $obstart_obfinish_time_hour."h ".$obstart_obfinish_time_minute."m ".$obstart_obfinish_time_second."s";
                        }
                    }

                    $obfinish_obgo_time = $row->obfinish_obgo_time;
                    if ($obfinish_obgo_time == '-838:59:59') {
                        $obfinish_obgo_time = date('H:i:s', strtotime('00:00:00'));

                        $obfinish_obgo_time_exp = explode(":", $obfinish_obgo_time);
                        $obfinish_obgo_time_hour = $obfinish_obgo_time_exp[0];
                        $obfinish_obgo_time_minute = $obfinish_obgo_time_exp[1];
                        $obfinish_obgo_time_second = $obfinish_obgo_time_exp[2];

                        $obfinish_obgo_time_display = "";
                    } else {
                        $obfinish_obgo_time = $row->obfinish_obgo_time;

                        $obfinish_obgo_time_exp = explode(":", $obfinish_obgo_time);
                        $obfinish_obgo_time_hour = $obfinish_obgo_time_exp[0];
                        $obfinish_obgo_time_minute = $obfinish_obgo_time_exp[1];
                        $obfinish_obgo_time_second = $obfinish_obgo_time_exp[2];

                        if ($obfinish_obgo_time_hour == '00') {
                            $obfinish_obgo_time_display = $obfinish_obgo_time_minute."m ".$obfinish_obgo_time_second."s";
                        } else {
                            $obfinish_obgo_time_display = $obfinish_obgo_time_hour."h ".$obfinish_obgo_time_minute."m ".$obfinish_obgo_time_second."s";
                        }
                    }

                    $obfinish_obtransfer_time = $row->obfinish_obtransfer_time;
                    if ($obfinish_obtransfer_time == '-838:59:59') {
                        $obfinish_obtransfer_time = date('H:i:s', strtotime('00:00:00'));

                        $obfinish_obtransfer_time_exp = explode(":", $obfinish_obtransfer_time);
                        $obfinish_obtransfer_time_hour = $obfinish_obtransfer_time_exp[0];
                        $obfinish_obtransfer_time_minute = $obfinish_obtransfer_time_exp[1];
                        $obfinish_obtransfer_time_second = $obfinish_obtransfer_time_exp[2];

                        $obfinish_obtransfer_time_display = "";
                    } else {
                        $obfinish_obtransfer_time = $row->obfinish_obtransfer_time;

                        $obfinish_obtransfer_time_exp = explode(":", $obfinish_obtransfer_time);
                        $obfinish_obtransfer_time_hour = $obfinish_obtransfer_time_exp[0];
                        $obfinish_obtransfer_time_minute = $obfinish_obtransfer_time_exp[1];
                        $obfinish_obtransfer_time_second = $obfinish_obtransfer_time_exp[2];

                        if ($obfinish_obtransfer_time_hour == '00') {
                            $obfinish_obtransfer_time_display = $obfinish_obtransfer_time_minute."m ".$obfinish_obtransfer_time_second."s";
                        } else {
                            $obfinish_obtransfer_time_display = $obfinish_obtransfer_time_hour."h ".$obfinish_obtransfer_time_minute."m ".$obfinish_obtransfer_time_second."s";
                        }
                    }

                    $dash = "-";
                    if (preg_match("/$dash/i", $come_triage_time)) {
                        $bgcolor_come_triage_time = "bg-danger";
                    } else {
                        $bgcolor_come_triage_time = "";
                    }

                    if (preg_match("/$dash/i", $triage_checkup_time)) {
                        $bgcolor_triage_checkup_time = "bg-danger";
                    } else {
                        $bgcolor_triage_checkup_time = "";
                    }

                    if (preg_match("/$dash/i", $checkup_obstart_time)) {
                        $bgcolor_checkup_obstart_time = "bg-danger";
                    } else {
                        $bgcolor_checkup_obstart_time = "";
                    }

                    if (preg_match("/$dash/i", $obstart_obfinish_time)) {
                        $bgcolor_obstart_obfinish_time = "bg-danger";
                    } else {
                        $bgcolor_obstart_obfinish_time = "";
                    }

                    if (preg_match("/$dash/i", $obfinish_obgo_time)) {
                        $bgcolor_obfinish_obgo_time = "bg-danger";
                    } else {
                        $bgcolor_obfinish_obgo_time = "";
                    }

                    if (preg_match("/$dash/i", $obfinish_obtransfer_time)) {
                        $bgcolor_obfinish_obtransfer_time = "bg-danger";
                    } else {
                        $bgcolor_obfinish_obtransfer_time = "";
                    }

                    $time = [
                        $come_triage_time, $triage_checkup_time, $checkup_obstart_time, $obstart_obfinish_time, $obfinish_obgo_time, $obfinish_obtransfer_time
                    ];

                    $total = 0;
    
                    foreach($time as $element):
                        $temp = explode(":", $element);
                    
                        if (preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1] || preg_match("/$dash/i", $temp[2]))) {
                            $total = $total;
                        } else {
                            $total+= (int) $temp[0] * 3600;
                        }

                        if (preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1] || preg_match("/$dash/i", $temp[2]))) {
                            $total = $total;
                        } else {
                            $total+= (int) $temp[1] * 60;
                        }

                        if (preg_match("/$dash/i", $temp[0]) || preg_match("/$dash/i", $temp[1] || preg_match("/$dash/i", $temp[2]))) {
                            $total = $total;
                        } else {
                            $total+= (int) $temp[2];
                        }

                    endforeach;
                    if (($total / 3600) >= '1') {
                        $total_waktu = sprintf('%02dh %02dm %02ds', ($total / 3600), ($total / 60 % 60), $total % 60);
                    } else {
                        $total_waktu = sprintf('%02dm %02ds', ($total / 60 % 60), $total % 60);
                    }
                    
                    if ($row->patient_khusus == "1") {
                        $patient_khusus = "Pasien Khusus";
                    } else {
                        $patient_khusus = "";
                    }
                    $data['listReport'] .= "<tr style='font-size:11px;'>
                                                <td style='border: 1px solid black;'>".$no.".</td>
                                                <td style='border: 1px solid black;'>".$patient_mr."</td>
                                                <td style='border: 1px solid black;'>".$row->patient_name."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_come_triage_time."'>".$come_triage_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_triage_checkup_time."'>".$triage_checkup_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_checkup_obstart_time."'>".$checkup_obstart_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_obstart_obfinish_time."'>".$obstart_obfinish_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_obfinish_obgo_time."'>".$obfinish_obgo_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;' class='".$bgcolor_obfinish_obtransfer_time."'>".$obfinish_obtransfer_time_display."</td>
                                                <td style='border: 1px solid black;text-align:center;'><b>".$total_waktu."</b></td>
                                                <td style='border: 1px solid black;text-align:center;'>".$patient_khusus."</td>
                                            </tr>";
                }
            } else {
                $data['listReport'] .= "<tr><td colspan='11' class='bg-danger' align='center' style='border:1px solid black;color:#fff;'>Tidak ada data</td></tr>";
            }

            $data['listReport'] .= "</tbody></table>";

            $totalTriageBlack = $this->ModelDashboard->getTotalTriageBlack($from_date, $to_date);
            $totalTriageRed = $this->ModelDashboard->getTotalTriageRed($from_date, $to_date);
            $totalTriageYellow = $this->ModelDashboard->getTotalTriageYellow($from_date, $to_date);
            $totalTriageGreen = $this->ModelDashboard->getTotalTriageGreen($from_date, $to_date);
            $totalPasienPulang = $this->ModelDashboard->getTotalPasienPulang($from_date, $to_date);
            $totalPasienRanap = $this->ModelDashboard->getTotalPasienRanap($from_date, $to_date);
            $totalPasienKhusus = $this->ModelDashboard->getTotalPasienKhusus($from_date, $to_date);

            $data['tableTotal'] = "<table class='table' style='width:900px;'>
                                    <tr>
                                        <th colspan='4' class='lightgrey' style='border: 1px solid black;'>Total Pasien Sesuai Triage</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-danger' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;width:100px;'>Merah</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageRed." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-warning' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Kuning</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageYellow." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-success' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Hijau</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageGreen." pasien</th>
                                    </tr>
                                    <tr>
                                        <th class='bg-dark' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;color:#fff;'>Hitam</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalTriageBlack." pasien</th>
                                    </tr>
                                   </table>
                                
                                   <table class='table' style='width:900px;'>
                                    <tr>
                                        <th colspan='3' class='lightgrey' style='border: 1px solid black;'>Total Pasien Pulang, Pasien Rawat Inap dan Pasien Khusus</th>
                                    </tr>
                                    <tr>
                                        <th class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;width:180px;'>Total Pasien Pulang</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienPulang." pasien</th>
                                    </tr>
                                    <tr>
                                        <th  class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Rawat Inap</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienRanap." pasien</th>
                                    </tr>
                                    <tr>
                                        <th  class='lightgrey' colspan='2' style='border: 1px solid black;font-size:12px;text-align:center;'>Total Pasien Khusus</th>
                                        <th style='border: 1px solid black;font-size:12px;' colspan='2'>".$totalPasienKhusus." pasien</th>
                                    </tr>
                                   </table>";
        }

        $this->load->view("download.php", $data);
    }

    public function saveNotes() {
        $ts_id = $this->input->post("ts_id");
        $notes = $this->input->post("notes");

        $saveNotes = $this->ModelDashboard->saveNotes($ts_id, $notes);
    }
}