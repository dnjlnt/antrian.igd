<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }
	
	public function index() {

		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

		$prefmr = "01";

		$no = 0;
		$data['listPatient'] = "";
		$getAllPatientIGD = $this->ModelDashboard->getAllPatientIGD();
		if ($getAllPatientIGD !== false) {
			foreach ($getAllPatientIGD as $row) {

				$no++;

				if ($row->patient_mr == "") {
					$patient_mr = "Nomor Rekam Medis: -";
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

				if ($row->patient_gender == "0" || $row->patient_gender == 0) {
					$bg = "background: #87CEFA;font-size:12px;";
				} else {
					$bg = "background: #FF69B4;font-size:12px;";
				}

				if ($row->patient_dob == "" || $row->patient_dob == "0000-00-00") {
					$patient_dob = "Umur: -";
				} else {
					$patient_dob = "".hitung_umur($row->patient_dob)."";
				}

				$patient_name = "<span style='font-size:10px;'><i>".$patient_mr."</i></span><br>
								 <span style='font-size:10px;'><i>".$patient_dob."</i></span><br>
								 <span style='font-size:15px;'><b>".$row->patient_title." ".$row->patient_name."</span><br><br>
								 <i><small>(Cari Pasien, Hapus Pasien, Panggil Antrian, Pasien Masuk)</small></i>";

				if ($row->patient_bed !== "") {
					$bgpatient_bed = "background-image: linear-gradient(white 85%, #D3D3D3);";

					if ($row->patient_bed == "resusitasi") {
						$patient_bed = "Resusitasi";
					} else if ($row->patient_bed == "tindakan") {
						$patient_bed = "Tindakan";
					} else if ($row->patient_bed == "ponek") {
						$patient_bed = "Ponek";
					} else if ($row->patient_bed == "isolasi") {
						$patient_bed = "Isolasi";
					} else {
						$patient_bed = $row->patient_bed;
					}
				} else {
					$bgpatient_bed = "";
					$patient_bed = "";
				}

				if ($row->patient_come == "0000-00-00 00:00:00") {
					$class_patient_come = "";
					$id_patient_come = "patient-come";
					$patient_come = "<button class='btn btn-sm btn-light' onclick='patientCome(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$bgcome = "";
					$patient_triage = "";
				} else {
					$class_patient_come = "patient_come";
					$id_patient_come = "patient-come-".$row->time_stamp_id."";
					$patient_come = explode(" ", $row->patient_come);
					$patient_come_date = date_indo($patient_come[0]);
					$patient_come_time = $patient_come[1];
					$patient_triage = "<button class='btn btn-sm btn-light' onclick='getPatientTriage(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_come = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
										<span style='font-size:10px;'>".$patient_come_date."</span><br>
										<div style='text-align:center;'><b>".$patient_come_time."<b></div>
									 </div>";
					$bgcome = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_triage == "0000-00-00 00:00:00") {
					$class_patient_triage = "";
					$id_patient_triage = "patient-triage";
					$txtaligntriage = "text-align:center;";
					$bgtriage = "";
					$color = "color:#000;";
					$patient_checkup = "";
				} else {
					$class_patient_triage = "patient_triage";
					$id_patient_triage = "patient-triage-".$row->time_stamp_id."";
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

					$checkPatientAntrian = $this->ModelDashboard->checkPatientAntrian($row->time_stamp_id);
					if ($checkPatientAntrian != false) {
						foreach ($checkPatientAntrian as $rowAntrian) {
							if ($rowAntrian->time_stamp_id == "") {
								$icon = "";
							} else {
								if ($rowAntrian->antrian_status == '0') {
									$icon = "";
								} else {
									$icon = "<img src='".base_url()."assets/checklist.png' width='20' style='float:left;margin-right:-2px;'>";
								}
							}
						}
					} else {
						$icon = "";
					}

					$patient_triage = explode(" ", $row->patient_triage);
					$patient_triage_date = date_indo($patient_triage[0]);
					$patient_triage_time = $patient_triage[1];
					$patient_checkup = "<button class='btn btn-sm btn-light' onclick='patientCheckup(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>
											Click Here
										</button>";
					
					$patient_triage = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
										<span style='font-size:10px;'>".$patient_triage_date."</span><br>
										<div style='text-align:center;'>
											<b>".$patient_triage_time."</b><br>
											<span style='font-size:13px;'><strong>".$icon." Antrian ".$row->kode_warna."".$row->no_antrian."</span><strong>
										</div>
										<i><small>(Hapus Record, Ubah Warna Triage, Cetak Antrian)</small></i>
									   </div>";
					$txtaligntriage = "text-align:left;";
				}

				if ($row->patient_checkup == "0000-00-00 00:00:00") {
					$class_patient_checkup = "";
					$id_patient_checkup = "patient-checkup";
					$bgcheckup = "";
					$patient_checkup_dpjp = "";
					$patient_observation_start = "";
				} else {
					$class_patient_checkup = "patient_checkup";
					$id_patient_checkup = "patient-checkup-".$row->time_stamp_id."";
					$patient_checkup = explode(" ", $row->patient_checkup);
					$patient_checkup_date = date_indo($patient_checkup[0]);
					$patient_checkup_time = $patient_checkup[1];
					$patient_checkup_dpjp = "<button class='btn btn-sm btn-light' onclick='patientCheckupDpjp(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$patient_observation_start = "<button class='btn btn-sm btn-light' onclick='patientObStart(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_checkup = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
											<span style='font-size:10px;'>".$patient_checkup_date."</span><br><div style='text-align:center;'><b>".$patient_checkup_time."</b></div>
									    </div>";
					$bgcheckup = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_checkup_dpjp == "0000-00-00 00:00:00") {
					$class_patient_checkup_dpjp = "";
					$id_patient_checkup_dpjp = "patient-checkup-dpjp";
					$bgcheckup_dpjp = "";
				} else {
					$class_patient_checkup_dpjp = "patient_checkup_dpjp";
					$id_patient_checkup_dpjp = "patient-checkup-dpjp-".$row->time_stamp_id."";
					$patient_checkup_dpjp = explode(" ", $row->patient_checkup_dpjp);
					$patient_checkup_dpjp_date = date_indo($patient_checkup_dpjp[0]);
					$patient_checkup_dpjp_time = $patient_checkup_dpjp[1];
					
					$patient_checkup_dpjp = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
											<span style='font-size:10px;'>".$patient_checkup_dpjp_date."</span><br><div style='text-align:center;'><b>".$patient_checkup_dpjp_time."</b></div>
									    </div>";
					$bgcheckup_dpjp = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_observation_start == "0000-00-00 00:00:00") {
					$class_patient_obstart = "";
					$id_patient_obstart = "patient-observation-start";
					$bgobstart = "";
					$patient_observation_finish = "";
				} else {
					$class_patient_obstart = "patient_obstart";
					$id_patient_obstart = "patient-observation-start-".$row->time_stamp_id."";
					$patient_observation_start = explode(" ", $row->patient_observation_start);
					$patient_obstart_date = date_indo($patient_observation_start[0]);
					$patient_obstart_time = $patient_observation_start[1];
					$patient_observation_finish = "<button class='btn btn-sm btn-light' onclick='patientObFinish(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_observation_start = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
													<span style='font-size:10px;'>".$patient_obstart_date."</span><br><div style='text-align:center;'><b>".$patient_obstart_time."</b></div>
												  </div>";
					$bgobstart = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_observation_finish == "0000-00-00 00:00:00") {
					$class_patient_obfinish = "";
					$id_patient_obfinish = "patient-observation-finish";
					$bgobfinish = "";
					$patient_go = "";
					$patient_transfer = "";
				} else {
					$class_patient_obfinish = "patient_obfinish";
					$id_patient_obfinish = "patient-observation-finish-".$row->time_stamp_id."";
					$patient_observation_finish = explode(" ", $row->patient_observation_finish);
					$patient_obfinish_date = date_indo($patient_observation_finish[0]);
					$patient_obfinish_time = $patient_observation_finish[1];

					$patient_go = "<button class='btn btn-sm btn-light' onclick='patientGo(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$patient_transfer = "<button class='btn btn-sm btn-light' onclick='patientTransfer(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_observation_finish = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
													<span style='font-size:10px;'>".$patient_obfinish_date."</span><br><div style='text-align:center;'><b>".$patient_obfinish_time."</b></div>
												   </div>
												   <div class='col-2' style='float:right;padding-left:0px;padding-right:0px;margin-top:-3px;'>";
					$bgobfinish = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_go == "0000-00-00 00:00:00") {
					$class_patient_go = "";
					$id_patient_go = "patient-go";
					$bggo = "";
					
				} else {
					$class_patient_go = "patient_go";
					$id_patient_go = "patient-go-".$row->time_stamp_id."";
					$patient_go = explode(" ", $row->patient_go);
					$patient_go_date = date_indo($patient_go[0]);
					$patient_go_time = $patient_go[1];
					

					$patient_go = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
									<span style='font-size:10px;'>".$patient_go_date."</span><br><div style='text-align:center;'><b>".$patient_go_time."</b></div>
								   </div>";
					$bggo = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_transfer == "0000-00-00 00:00:00") {
					$class_patient_transfer = "";
					$id_patient_transfer = "patient-transfer";
					$bgtransfer = "";
					
				} else {
					$class_patient_transfer = "patient_transfer";
					$id_patient_transfer = "patient-transfer-".$row->time_stamp_id."";
					$patient_transfer = explode(" ", $row->patient_transfer);
					$patient_transfer_date = date_indo($patient_transfer[0]);
					$patient_transfer_time = $patient_transfer[1];

					$patient_transfer = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
											<span style='font-size:10px;'>".$patient_transfer_date."</span><br><div style='text-align:center;'><b>".$patient_transfer_time."</b></div>
										 </div>";
					$bgtransfer = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_khusus == "") {
					$id_patient_khusus = "patient-khusus";
					$class_patient_khusus = "";
					$patient_khusus = "<input type='radio' value='".$row->time_stamp_id."' name='patient_khusus' onclick='patientKhusus(\"$row->time_stamp_id\")'> Pasien Khusus?</input>";
					$bgpatient_khusus = "";
				} else {
					$class_patient_khusus = "patient_special";
					$id_patient_khusus = "patient-khusus-".$row->time_stamp_id."";
					$patient_khusus = "<div style='padding-left:0px;padding-top:5px;padding-bottom:8px;padding-right:0px;text-align:center;background:blue;color:white;margin-top:5px;'>
											Pasien Khusus
									   </div>";
					$bgpatient_khusus = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_come !== "0000-00-00 00:00:00") {
					if ($row->patient_triage !== "0000-00-00 00:00:00") {
						if ($row->patient_checkup !== "0000-00-00 00:00:00") {
							if ($row->patient_observation_start !== "0000-00-00 00:00:00") {
								if ($row->patient_observation_finish !== "0000-00-00 00:00:00") {
									if ($row->patient_go !== "0000-00-00 00:00:00") {
											$btnswap = "<button class='btn_swap' onclick='patientSwap(\"$row->time_stamp_id\")'></button>";
											$patient_transfer = "";
									} else {
										if ($row->patient_transfer !== "0000-00-00 00:00:00") {
											$btnswap = "<button class='btn_swap' onclick='patientSwap(\"$row->time_stamp_id\")'></button>";
											$patient_go = "";
										} else {
											$btnswap = "";
										}
									}
								} else {
									$btnswap = "";
								}
							} else {
								$btnswap = "";
							}
						} else {
							$btnswap = "";
						}
					} else {
						$btnswap = "";
					}
				} else {
					$btnswap = "";
				}

				$data['listPatient'] .= "<tr>
											<td style='font-size:12px;width:20px;border:1px solid black;'>".$no.".</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='patient-mr-".$row->time_stamp_id."' class='patient_mr' style='".$bg."border:1px solid black;width:190px;text-align:left;'>
												".$patient_name."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_come."' class='".$class_patient_come."' style='font-size:12px;width:90px;border:1px solid black;".$bgcome."'>
												".$patient_come."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_triage."' class='".$class_patient_triage." ".$bgtriage."' style='font-size:12px;width:90px;border:1px solid black;".$color."".$txtaligntriage."'>
												".$patient_triage."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='patient-bed-".$row->time_stamp_id."' class='patient_bed' style='font-size:12px;border:1px solid black;width:50px;".$bgpatient_bed."'>
												".$patient_bed."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_checkup."' class='".$class_patient_checkup."' style='font-size:12px;width:100px;border:1px solid black;".$bgcheckup."'>
												".$patient_checkup."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_checkup_dpjp."' class='".$class_patient_checkup_dpjp."' style='font-size:12px;width:100px;border:1px solid black;".$bgcheckup_dpjp."'>
												".$patient_checkup_dpjp."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_obstart."' class='".$class_patient_obstart."' style='font-size:12px;width:90px;border:1px solid black;".$bgobstart."'>
												".$patient_observation_start."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_obfinish."' class='".$class_patient_obfinish."' style='font-size:12px;width:90px;border:1px solid black;".$bgobfinish."'>
												".$patient_observation_finish."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_go."' class='".$class_patient_go."' style='font-size:12px;width:90px;border:1px solid black;".$bggo."'>
												".$patient_go."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_transfer."' class='".$class_patient_transfer."' style='font-size:12px;width:90px;border:1px solid black;".$bgtransfer	."'>
												".$patient_transfer."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_khusus."' class='".$class_patient_khusus."' style='font-size:12px;width:90px;border:1px solid black;".$bgpatient_khusus."'>
												".$patient_khusus."
											</td>
											<td data-timestamp-id='".$row->time_stamp_id."' id='remove-patient' style='font-size:12px;border:1px solid black;width:40px;'>
												".$btnswap."
											</td>
										</tr>";
			}
		} else {
			$data['listPatient'] .= "";
		}

		$this->load->view("index.php", $data);
	}

	public function password() {

		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

		$prefmr = "01";

		$this->load->view("password.php");
	}

	public function edit() {
		$time_stamp_id = $_GET["id"];
		$dataPatient = $this->ModelDashboard->getPatientDataByTsID($time_stamp_id);
		if ($dataPatient != false) {
			foreach ($dataPatient as $row) {
				$data["namaPasien"] = $row->patient_name;
				$data["nomorHandphone"] = $row->patient_phone_number;
				$data["tanggalLahir"] = $row->patient_dob;
				$jenisKelamin = $row->patient_gender;
			}
		} else {
			$$data["namaPasien"] = "";
			$$data["nomorHandphone"] = "";
			$$data["tanggalLahir"] = "";
			$jenisKelamin = "";
		}

		if ($jenisKelamin == "1") {
			$data["jenisKelamin"] = "<input class='form-control' type='text' id='gender' name='gender' value='Perempuan' readonly>";
		} else {
			$data["jenisKelamin"] = "<input class='form-control' type='text' id='gender' name='gender' value='Laki-laki' readonly>";
		}

		$this->load->view("form_edit_patient.php", $data);
	}

	public function update() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$nama_pasien = $this->input->post("nama_pasien");
		$no_hp = $this->input->post("no_hp");
		$tanggal_lahir = $this->input->post("tanggal_lahir");

		$update = $this->ModelDashboard->updateDataPatient($time_stamp_id, $nama_pasien, $no_hp, $tanggal_lahir);
		if ($update == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Berhasil memperbaharui data pasien"
			);

			echo json_encode($arr);
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal memperbaharui data pasien"
			);

			echo json_encode($arr);
		}
	}

	public function getListData() {
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

		// if ($url == "http://192.168.15.9:1026") {
		// 	$prefmr = "02";
		// } else if ($url == "http://192.168.19.21:2300") {
		// 	$prefmr = "03";
		// } else {
			$prefmr = "01";
		// }

		$no = 0;
		$listPatient = "";
		$getAllPatientIGD = $this->ModelDashboard->getAllPatientIGD();
		if ($getAllPatientIGD !== false) {
			foreach ($getAllPatientIGD as $row) {
				$no++;

				if ($row->patient_mr == "") {
					$patient_mr = "Nomor Rekam Medis: -";
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

				if ($row->patient_gender == "0" || $row->patient_gender == 0) {
					$bg = "background: #87CEFA;font-size:12px;";
				} else {
					$bg = "background: #FF69B4;font-size:12px;";
				}

				if ($row->patient_dob == "" || $row->patient_dob == "0000-00-00") {
					$patient_dob = "Umur: -";
				} else {
					$patient_dob = "".hitung_umur($row->patient_dob)."";
				}

				$patient_name = "<span style='font-size:10px;'><i>".$patient_mr."</i></span><br>
								 <span style='font-size:10px;'><i>".$patient_dob."</i></span><br>
								 <span style='font-size:15px;'><b>".$row->patient_title." ".$row->patient_name."</span><br><br>
								 <i><small>(Cari Pasien, Hapus Pasien, Panggil Antrian, Pasien Masuk)</small></i>";

				if ($row->patient_bed !== "") {
					$bgpatient_bed = "background-image: linear-gradient(white 85%, #D3D3D3);";

					if ($row->patient_bed == "resusitasi") {
						$patient_bed = "Resusitasi";
					} else if ($row->patient_bed == "tindakan") {
						$patient_bed = "Tindakan";
					} else if ($row->patient_bed == "ponek") {
						$patient_bed = "Ponek";
					} else if ($row->patient_bed == "isolasi") {
						$patient_bed = "Isolasi";
					} else {
						$patient_bed = $row->patient_bed;
					}
				} else {
					$bgpatient_bed = "";
					$patient_bed = "";
				}

				if ($row->patient_come == "0000-00-00 00:00:00") {
					$class_patient_come = "";
					$id_patient_come = "patient-come";
					$patient_come = "<button class='btn btn-sm btn-light' onclick='patientCome(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$bgcome = "";
					$patient_triage = "";
				} else {
					$class_patient_come = "patient_come";
					$id_patient_come = "patient-come-".$row->time_stamp_id."";
					$patient_come = explode(" ", $row->patient_come);
					$patient_come_date = date_indo($patient_come[0]);
					$patient_come_time = $patient_come[1];
					$patient_triage = "<button class='btn btn-sm btn-light' onclick='getPatientTriage(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_come = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
										<span style='font-size:10px;'>".$patient_come_date."</span><br><div style='text-align:center;'><b>".$patient_come_time."<b></div>
									 </div>";
					$bgcome = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_triage == "0000-00-00 00:00:00") {
					$class_patient_triage = "";
					$id_patient_triage = "patient-triage";
					$txtaligntriage = "text-align:center;";
					$bgtriage = "";
					$color = "color:#000;";
					$patient_checkup = "";
				} else {
					$class_patient_triage = "patient_triage";
					$id_patient_triage = "patient-triage-".$row->time_stamp_id."";
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

					$checkPatientAntrian = $this->ModelDashboard->checkPatientAntrian($row->time_stamp_id);
					if ($checkPatientAntrian != false) {
						foreach ($checkPatientAntrian as $rowAntrian) {
							if ($rowAntrian->time_stamp_id == "") {
								$icon = "";
							} else {
								if ($rowAntrian->antrian_status == '0') {
									$icon = "";
								} else {
									$icon = "<img src='".base_url()."assets/checklist.png' width='20' style='float:left;margin-right:-2px;'>";
								}
							}
						}
					} else {
						$icon = "";
					}

					if ($row->triage_color == "black") {
						$antrian = "";
						$ket = "";
					} else {
						$antrian = "<span style='font-size:10px;'>
										<span style='font-size:13px;'><strong>".$icon." Antrian ".$row->kode_warna."".$row->no_antrian."</span><strong>
									</span>";
						$ket = "<i><small>(Hapus Record, Ubah Warna Triage, Cetak Antrian)</small></i>";
					}

					$patient_triage = explode(" ", $row->patient_triage);
					$patient_triage_date = date_indo($patient_triage[0]);
					$patient_triage_time = $patient_triage[1];
					$patient_checkup = "<button class='btn btn-sm btn-light' onclick='patientCheckup(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					
					$patient_triage = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
										<span style='font-size:10px;'>".$patient_triage_date."</span><br>
										<div style='text-align:center;'>
											<b>".$patient_triage_time."</b><br>
											".$antrian."
										</div>
										".$ket."
									   </div>";
					$txtaligntriage = "text-align:left;";
				}

				if ($row->patient_checkup == "0000-00-00 00:00:00") {
					$class_patient_checkup = "";
					$id_patient_checkup = "patient-checkup";
					$bgcheckup = "";
					$patient_checkup_dpjp = "";
					$patient_observation_start = "";
				} else {
					$class_patient_checkup = "patient_checkup";
					$id_patient_checkup = "patient-checkup-".$row->time_stamp_id."";
					$patient_checkup = explode(" ", $row->patient_checkup);
					$patient_checkup_date = date_indo($patient_checkup[0]);
					$patient_checkup_time = $patient_checkup[1];
					$patient_checkup_dpjp = "<button class='btn btn-sm btn-light' onclick='patientCheckupDpjp(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$patient_observation_start = "<button class='btn btn-sm btn-light' onclick='patientObStart(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_checkup = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
											<span style='font-size:10px;'>".$patient_checkup_date."</span><br><div style='text-align:center;'><b>".$patient_checkup_time."</b></div>
									    </div>";
					$bgcheckup = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_checkup_dpjp == "0000-00-00 00:00:00") {
					$class_patient_checkup_dpjp = "";
					$id_patient_checkup_dpjp = "patient-checkup-dpjp";
					$bgcheckup_dpjp = "";
				} else {
					$class_patient_checkup_dpjp = "patient_checkup_dpjp";
					$id_patient_checkup_dpjp = "patient-checkup-dpjp-".$row->time_stamp_id."";
					$patient_checkup_dpjp = explode(" ", $row->patient_checkup_dpjp);
					$patient_checkup_dpjp_date = date_indo($patient_checkup_dpjp[0]);
					$patient_checkup_dpjp_time = $patient_checkup_dpjp[1];
					
					$patient_checkup_dpjp = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
												<span style='font-size:10px;'>".$patient_checkup_dpjp_date."</span><br><div style='text-align:center;'><b>".$patient_checkup_dpjp_time."</b></div>
									    	 </div>";
					$bgcheckup_dpjp = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_observation_start == "0000-00-00 00:00:00") {
					$class_patient_obstart = "";
					$id_patient_obstart = "patient-observation-start";
					$bgobstart = "";
					$patient_observation_finish = "";
				} else {
					$class_patient_obstart = "patient_obstart";
					$id_patient_obstart = "patient-observation-start-".$row->time_stamp_id."";
					$patient_observation_start = explode(" ", $row->patient_observation_start);
					$patient_obstart_date = date_indo($patient_observation_start[0]);
					$patient_obstart_time = $patient_observation_start[1];
					$patient_observation_finish = "<button class='btn btn-sm btn-light' onclick='patientObFinish(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_observation_start = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
													<span style='font-size:10px;'>".$patient_obstart_date."</span><br><div style='text-align:center;'><b>".$patient_obstart_time."</b></div>
												  </div>";
					$bgobstart = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_observation_finish == "0000-00-00 00:00:00") {
					$class_patient_obfinish = "";
					$id_patient_obfinish = "patient-observation-finish";
					$bgobfinish = "";
					$patient_go = "";
					$patient_transfer = "";
				} else {
					$class_patient_obfinish = "patient_obfinish";
					$id_patient_obfinish = "patient-observation-finish-".$row->time_stamp_id."";
					$patient_observation_finish = explode(" ", $row->patient_observation_finish);
					$patient_obfinish_date = date_indo($patient_observation_finish[0]);
					$patient_obfinish_time = $patient_observation_finish[1];

					$patient_go = "<button class='btn btn-sm btn-light' onclick='patientGo(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";
					$patient_transfer = "<button class='btn btn-sm btn-light' onclick='patientTransfer(\"$row->time_stamp_id\")' style='font-size:11px;width:90px;height:40px;'>Click Here</button>";

					$patient_observation_finish = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
													<span style='font-size:10px;'>".$patient_obfinish_date."</span><br><div style='text-align:center;'><b>".$patient_obfinish_time."</b></div>
												   </div>
												   <div class='col-2' style='float:right;padding-left:0px;padding-right:0px;margin-top:-3px;'>";
					$bgobfinish = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_go == "0000-00-00 00:00:00") {
					$class_patient_go = "";
					$id_patient_go = "patient-go";
					$bggo = "";
					
				} else {
					$class_patient_go = "patient_go";
					$id_patient_go = "patient-go-".$row->time_stamp_id."";
					$patient_go = explode(" ", $row->patient_go);
					$patient_go_date = date_indo($patient_go[0]);
					$patient_go_time = $patient_go[1];
					

					$patient_go = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
									<span style='font-size:10px;'>".$patient_go_date."</span><br><div style='text-align:center;'><b>".$patient_go_time."</b></div>
								   </div>";
					$bggo = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_transfer == "0000-00-00 00:00:00") {
					$class_patient_transfer = "";
					$id_patient_transfer = "patient-transfer";
					$bgtransfer = "";
					
				} else {
					$class_patient_transfer = "patient_transfer";
					$id_patient_transfer = "patient-transfer-".$row->time_stamp_id."";
					$patient_transfer = explode(" ", $row->patient_transfer);
					$patient_transfer_date = date_indo($patient_transfer[0]);
					$patient_transfer_time = $patient_transfer[1];

					$patient_transfer = "<div style='padding-left:0px;padding-right:0px;text-align:center;'>
											<span style='font-size:10px;'>".$patient_transfer_date."</span><br><div style='text-align:center;'><b>".$patient_transfer_time."</b></div>
										 </div>";
					$bgtransfer = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_khusus == "") {
					$id_patient_khusus = "patient-khusus";
					$class_patient_khusus = "";
					$patient_khusus = "<input type='radio' value='".$row->time_stamp_id."' name='patient_khusus' onclick='patientKhusus(\"$row->time_stamp_id\")'> Pasien Khusus?</input>";
					$bgpatient_khusus = "";
				} else {
					$class_patient_khusus = "patient_special";
					$id_patient_khusus = "patient-khusus-".$row->time_stamp_id."";
					$patient_khusus = "<div style='padding-left:0px;padding-top:5px;padding-bottom:8px;padding-right:0px;text-align:center;background:blue;color:white;margin-top:5px;'>
											Pasien Khusus
									   </div>";
					$bgpatient_khusus = "background-image: linear-gradient(white 85%, #D3D3D3);";
				}

				if ($row->patient_come !== "0000-00-00 00:00:00") {
					if ($row->patient_triage !== "0000-00-00 00:00:00") {
						if ($row->patient_checkup !== "0000-00-00 00:00:00") {
							if ($row->patient_observation_start !== "0000-00-00 00:00:00") {
								if ($row->patient_observation_finish !== "0000-00-00 00:00:00") {
									if ($row->patient_go !== "0000-00-00 00:00:00") {
											$patient_transfer = "";
									} else {
										if ($row->patient_transfer !== "0000-00-00 00:00:00") {
											$patient_go = "";
										} else {
											$btnswap = "";
										}
									}
								} else {
									$btnswap = "";
								}
							} else {
								$btnswap = "";
							}
						} else {
							$btnswap = "";
						}
					} else {
						$btnswap = "";
					}
				} else {
					$btnswap = "";
				}

				$btnswap = "<button class='btn_swap' onclick='patientSwap(\"$row->time_stamp_id\")'></button>";

				$listPatient .= "<tr>
									<td style='font-size:12px;width:20px;border:1px solid black;'>".$no.".</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='patient-mr-".$row->time_stamp_id."' class='patient_mr' style='".$bg."border:1px solid black;width:190px;text-align:left;'>
										".$patient_name." 
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_come."' class='".$class_patient_come."' style='font-size:12px;width:90px;border:1px solid black;".$bgcome."'>
										".$patient_come."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_triage."' class='".$class_patient_triage." ".$bgtriage."' style='font-size:12px;width:90px;border:1px solid black;".$color."".$txtaligntriage."'>
										".$patient_triage."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='patient-bed-".$row->time_stamp_id."' class='patient_bed' style='font-size:12px;border:1px solid black;width:50px;".$bgpatient_bed."'>
										".$patient_bed."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_checkup."' class='".$class_patient_checkup."' style='font-size:12px;width:100px;border:1px solid black;".$bgcheckup."'>
										".$patient_checkup."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_checkup_dpjp."' class='".$class_patient_checkup_dpjp."' style='font-size:12px;width:100px;border:1px solid black;".$bgcheckup_dpjp."'>
										".$patient_checkup_dpjp."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_obstart."' class='".$class_patient_obstart."' style='font-size:12px;width:90px;border:1px solid black;".$bgobstart."'>
										".$patient_observation_start."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_obfinish."' class='".$class_patient_obfinish."' style='font-size:12px;width:90px;border:1px solid black;".$bgobfinish."'>
										".$patient_observation_finish."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_go."' class='".$class_patient_go."' style='font-size:12px;width:90px;border:1px solid black;".$bggo."'>
										".$patient_go."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_transfer."' class='".$class_patient_transfer."' style='font-size:12px;width:90px;border:1px solid black;".$bgtransfer	."'>
										".$patient_transfer."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='".$id_patient_khusus."' class='".$class_patient_khusus."' style='font-size:12px;width:90px;border:1px solid black;".$bgpatient_khusus."'>
										".$patient_khusus."
									</td>
									<td data-timestamp-id='".$row->time_stamp_id."' id='remove-patient' style='font-size:12px;border:1px solid black;width:40px;'>
										".$btnswap."
									</td>
								</tr>";
			}
		} else {
			$listPatient .= "";
		}

		$listPatient .= "<script>
							$(document).ready(function(){
								$('.patient_mr').click(function(){
									var id = $(this).attr('data-timestamp-id');
									var left = (screen.width - 2000) / 2;
									var top = (screen.height - 1200) / 4;
									window.open('".base_url()."dashboard/formdatapasien?id='+id, '_blank', 'toolbar=no, location=no, menubar=0, top='+ top + ', left=' + left + ', height=1200, width=2000, scrollbars=yes');
								});
							});

							$(document).ready(function(){
								$('.patient_bed').click(function(){
									var id = $(this).attr('data-timestamp-id');
									var left = (screen.width - 500) / 2;
									var top = (screen.height - 600) / 4;
									window.open('".base_url()."dashboard/formbedpatient/'+id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=400, width=600, scrollbars=1');
								});
							});

							$(document).ready(function(){
								$('.patient_triage').click (function(){
		
									var id = $(this).attr('data-timestamp-id');
									var left = (screen.width - 800) / 2;
									var top = (screen.height - 700) / 4;
									window.open('".base_url()."dashboard/formupdatetriage?id='+id, '_blank', 'toolbar=no, location=no, menubar=0, top='+ top + ', left=' + left + ', height=700, width=800, scrollbars=yes');
								});
							});

							$(document).ready(function(){
								$('.patient_special').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus pasien khusus?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientkhusus',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_come').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientcome',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_checkup').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientcheckup',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_checkup_dpjp').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientcheckupdpjp',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_obstart').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientobstart',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_obfinish').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientobfinish',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_go').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatientgo',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
		
							$(document).ready(function(){
								$('.patient_transfer').click (function(){
									var id = $(this).attr('data-timestamp-id');
									var result = confirm('Hapus record?');
									if(result){
										$.ajax({
											type: 'post',
											url: '".base_url()."dashboard/removepatienttransfer',
											data: {ts_id:id},
											success: function (data) {
												if (data == 'successremovepatient') {
													window.location.reload();
												} else {
													alert('Gagal menghapus data');
													return;
												}
											}
										});
									} else {
										return false;
									}
								});
							});
						</script>";

		echo $listPatient;
	}

	public function addPatientMenXX() {
		$time_stamp_id = $this->ModelDashboard->getTimeStampID();
		$patient_gender = "0";
		$created_dttm = date('Y-m-d H:i:s');

		$savePatient = $this->ModelDashboard->savePatient($time_stamp_id, $patient_gender, $created_dttm);
		if ($savePatient == true) {
			echo "successsavepatient";
		} else {
			echo "failedsavepatient";
		}
	}

	public function addPatient() {
		if ($_GET["gender"] == "female") {
			$data["gender"] = "<input class='form-control' type='text' id='gender' name='gender' value='Perempuan' readonly>";
		} else {
			$data["gender"] = "<input class='form-control' type='text' id='gender' name='gender' value='Laki-laki' readonly>";
		}

		$this->load->view("form_add_patient.php", $data);
	}

	public function saveNewPatient() {
		$time_stamp_id = uniqid();
		$nama_pasien = $this->input->post("nama_pasien");
		$no_hp = $this->input->post("no_hp");
		$tanggal_lahir = $this->input->post("tanggal_lahir");
		$gender = $this->input->post("gender");
		$created_dttm = date('Y-m-d H:i:s');

		$saveNewPatient = $this->ModelDashboard->saveNewPatient($time_stamp_id, $nama_pasien, $no_hp, $tanggal_lahir, $gender, $created_dttm);
		if ($saveNewPatient == true) {
			$arr = array(
				"status" => "success",
				"message" => "Berhasil menyimpan pasien baru"
			);

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed",
				"message" => "Gagal menyimpan pasien baru"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function addPatientWomen() {
		$time_stamp_id = uniqid();
		$patient_gender = "1";
		$created_dttm = date('Y-m-d H:i:s');

		$savePatient = $this->ModelDashboard->savePatient($time_stamp_id, $patient_gender, $created_dttm);
		if ($savePatient == true) {
			echo "successsavepatient";
		} else {
			echo "failedsavepatient";
		}
	}

	public function deletePatientData() {
		$time_stamp_id = $this->input->post("time_stamp_id");

		$deletePatientData = $this->ModelDashboard->deletePatientData($time_stamp_id);
		if ($deletePatientData == true) {
			echo "successdeletepatientdata";
		} else {
			echo "faileddeletepatientdata";
		}
	}

	public function savePatientCome() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientCome = $this->ModelDashboard->savePatientCome($time_stamp_id, $dttm_update);
		if ($savePatientCome == true) {
			echo "successsavepatientcome";
		} else {
			echo "failedsavepatient";
		}
	}

	public function saveTriageRed() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dttm_update = date('Y-m-d H:i:s');

		$lastNoAntrianMerah = $this->ModelDashboard->getLastAntrianMerah();

		$getColorTriage = $this->ModelDashboard->getColorTriage($time_stamp_id);
		if ($getColorTriage === "") {
			$saveTriageRed = $this->ModelDashboard->saveTriageRed($time_stamp_id, $lastNoAntrianMerah, $dttm_update);
		} else {
			$saveTriageRed = $this->ModelDashboard->updateTriageRed($time_stamp_id, $lastNoAntrianMerah);
		}
		
		if ($saveTriageRed == true) {
			echo "successsavetriage";
		} else {
			echo "failedsavetriage";
		}
	}

	public function saveTriageYellow() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dttm_update = date('Y-m-d H:i:s');
		
		$lastNoAntrianKuning = $this->ModelDashboard->getLastAntrianKuning();

		$getColorTriage = $this->ModelDashboard->getColorTriage($time_stamp_id);
		if ($getColorTriage === "") {
			$saveTriageYellow = $this->ModelDashboard->saveTriageYellow($time_stamp_id, $lastNoAntrianKuning, $dttm_update);
		} else {
			$saveTriageYellow = $this->ModelDashboard->updateTriageYellow($time_stamp_id, $lastNoAntrianKuning);
		}

		if ($saveTriageYellow == true) {
			echo "successsavetriage";
		} else {
			echo "failedsavetriage";
		}
	}

	public function saveTriageGreen() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dttm_update = date('Y-m-d H:i:s');

		$lastNoAntrianHijau = $this->ModelDashboard->getLastAntrianHijau();

		$getColorTriage = $this->ModelDashboard->getColorTriage($time_stamp_id);
		if ($getColorTriage === "") {
			$saveTriageGreen = $this->ModelDashboard->saveTriageGreen($time_stamp_id, $lastNoAntrianHijau, $dttm_update);
		} else {
			$saveTriageGreen = $this->ModelDashboard->updateTriageGreen($time_stamp_id, $lastNoAntrianHijau);
		}

		if ($saveTriageGreen == true) {
			echo "successsavetriage";
		} else {
			echo "failedsavetriage";
		}
	}

	public function saveTriageBlack() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dttm_update = date('Y-m-d H:i:s');
		
		$getColorTriage = $this->ModelDashboard->getColorTriage($time_stamp_id);
		if ($getColorTriage === "") {
			$saveTriageBlack = $this->ModelDashboard->saveTriageBlack($time_stamp_id, $dttm_update);
		} else {
			$saveTriageBlack = $this->ModelDashboard->updateTriageBlack($time_stamp_id);
		}

		if ($saveTriageBlack == true) {
			echo "successsavetriage";
		} else {
			echo "failedsavetriage";
		}
	}

	public function saveTriage() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$kondisi_kritis = $this->input->post("kondisi_kritis");

		if (empty($kondisi_kritis)) {
			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "EMPTY"
			);

			echo json_encode($arr);
		} else if (in_array("COND_009", $kondisi_kritis)) {
			$saveKondisiKritis = $this->ModelDashboard->saveKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "DEKONTAMINASI"
			);

			echo json_encode($arr);
		} else if (in_array("COND_001", $kondisi_kritis)) {
			$saveKondisiKritis = $this->ModelDashboard->saveKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else if (in_array("COND_002", $kondisi_kritis)) {
			$saveKondisiKritis = $this->ModelDashboard->saveKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else if (in_array("COND_003", $kondisi_kritis)) {
			$saveKondisiKritis = $this->ModelDashboard->saveKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else {
			$saveKondisiKritis = $this->ModelDashboard->saveKondisiKritis($time_stamp_id, $kondisi_kritis);
			
			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI2"
			);

			echo json_encode($arr);
		}
	}

	public function updateKondisiKritis() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$kondisi_kritis = $this->input->post("kondisi_kritis");

		if (empty($kondisi_kritis)) {
			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "EMPTY"
			);

			echo json_encode($arr);
		} else if (in_array("COND_009", $kondisi_kritis)) {
			$updateKondisiKritis = $this->ModelDashboard->updateKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "DEKONTAMINASI"
			);

			echo json_encode($arr);
		} else if (in_array("COND_001", $kondisi_kritis)) {
			$updateKondisiKritis = $this->ModelDashboard->updateKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else if (in_array("COND_002", $kondisi_kritis)) {
			$updateKondisiKritis = $this->ModelDashboard->updateKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else if (in_array("COND_003", $kondisi_kritis)) {
			$updateKondisiKritis = $this->ModelDashboard->updateKondisiKritis($time_stamp_id, $kondisi_kritis);

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI1"
			);

			echo json_encode($arr);
		} else {
			$updateKondisiKritis = $this->ModelDashboard->updateKondisiKritis($time_stamp_id, $kondisi_kritis);
			
			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"result" => "ESI2"
			);

			echo json_encode($arr);
		}
	}

	public function saveDekontaminasi() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$result = $this->input->post("result");
		$dekontaminasi = $this->input->post("dekontaminasi");

		$arr = array(
			"time_stamp_id" => $time_stamp_id, 
			"dekontaminasi" => base64_encode($dekontaminasi),
			"result" => $result
		);

		echo json_encode($arr);
	}

	public function saveDoa() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dekontaminasi = $this->input->post("dekontaminasi");
		$result = $this->input->post("result");
		$death_on_arrival = $this->input->post("death_on_arrival");

		if ($death_on_arrival == "0") {
			$saveDoa = $this->ModelDashboard->saveDoa($time_stamp_id, $death_on_arrival, "", base64_decode($dekontaminasi));

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"dekontaminasi" => $dekontaminasi,
				"result" => $result,
				"doa" => base64_encode($death_on_arrival)
			);


			echo json_encode($arr);
		} else {
			$kode_warna = "black";

			$saveDoa = $this->ModelDashboard->saveDoa($time_stamp_id, $death_on_arrival, $kode_warna, base64_decode($dekontaminasi));
			if ($saveDoa == true) {
				$arr = array(
					"message" => "success", 
					"time_stamp_id" => $time_stamp_id
				);
	
				echo json_encode($arr);
			} else {
				$arr = array(
					"message" => "failed", 
					"time_stamp_id" => $time_stamp_id
				);
	
				echo json_encode($arr);
			}
		}
	}

	public function updateDoa() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dekontaminasi = $this->input->post("dekontaminasi");
		$result = $this->input->post("result");
		$death_on_arrival = $this->input->post("death_on_arrival");

		if ($death_on_arrival == "0") {
			$updateDoa = $this->ModelDashboard->updateDoa($time_stamp_id, $death_on_arrival, "", base64_decode($dekontaminasi));

			$arr = array(
				"time_stamp_id" => $time_stamp_id, 
				"dekontaminasi" => $dekontaminasi,
				"result" => $result,
				"doa" => base64_encode($death_on_arrival)
			);


			echo json_encode($arr);
		} else {
			$kode_warna = "black";

			$updateDoa = $this->ModelDashboard->updateDoa($time_stamp_id, $death_on_arrival, $kode_warna, base64_decode($dekontaminasi));
			if ($updateDoa == true) {
				$arr = array(
					"message" => "success", 
					"time_stamp_id" => $time_stamp_id
				);
	
				echo json_encode($arr);
			} else {
				$arr = array(
					"message" => "failed", 
					"time_stamp_id" => $time_stamp_id
				);
	
				echo json_encode($arr);
			}
		}
	}

	public function saveTtv() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dekontaminasi = $this->input->post("dekontaminasi");
		$doa = $this->input->post("doa");
		$result = base64_decode($this->input->post("result"));
		$tekanan_darah_sistolik = $this->input->post("tekanan_darah_sistolik");
		$tekanan_darah_diastolik = $this->input->post("tekanan_darah_diastolik");
		$respirasi = $this->input->post("respirasi");
		$saturasi = $this->input->post("saturasi");
		$nadi = $this->input->post("nadi");
		$suhu = $this->input->post("suhu");

		if ($result == "ESI1" || $result == "ESI2") {
			$kode_warna = "M";
			$kode_warna2 = "red";
			$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();

			$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, $result, $kode_warna, $kode_warna2, $lastNoAntrian);
			if ($saveTtm == true) {
				$arr = array(
					"message" => "success", 
					"time_stamp_id" => $time_stamp_id, 
					"result" => $result
				);
	
				echo json_encode($arr);
			} else {
				$arr = array(
					"message" => "failed", 
					"time_stamp_id" => $time_stamp_id, 
					"result" => $result
				);
	
				echo json_encode($arr);
			}
		} else {
			$patientData = $this->ModelDashboard->getPatientDataByTsID($time_stamp_id);
			if ($patientData != false) {
				foreach ($patientData as $data) {
					$patientDob = $data->patient_dob;
				}
			}

			$patientDob = new DateTime($patientDob);
			$today = new DateTime('today');

			$y = $today->diff($patientDob)->y;
			$m = $today->diff($patientDob)->m;
			$d = $today->diff($patientDob)->d;
			
			if ($y == 0) {
				if ($m < 3) {
					if ($nadi > "180" && $respirasi > "50" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else {
					if ($nadi > "260" && $respirasi > "40" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
						
						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				}
			} else {
				if ($y > 0 && $y < 3) {
					if ($nadi > "260" && $respirasi > "40" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
						
						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else if ($y >= 3 && $y < 8) {
					if ($nadi > "140" && $respirasi > "30" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else {
					if ($nadi > "100" && $respirasi > "20" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$saveTtm = $this->ModelDashboard->saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($saveTtm == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				}
			}
		}
	}

	public function updateTtv() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dekontaminasi = $this->input->post("dekontaminasi");
		$doa = $this->input->post("doa");
		$result = base64_decode($this->input->post("result"));
		$tekanan_darah_sistolik = $this->input->post("tekanan_darah_sistolik");
		$tekanan_darah_diastolik = $this->input->post("tekanan_darah_diastolik");
		$respirasi = $this->input->post("respirasi");
		$saturasi = $this->input->post("saturasi");
		$nadi = $this->input->post("nadi");
		$suhu = $this->input->post("suhu");

		if ($result == "ESI1" || $result == "ESI2") {
			$kode_warna = "M";
			$kode_warna2 = "red";
			$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();

			$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, $result, $kode_warna, $kode_warna2, $lastNoAntrian);
			if ($updateTtv == true) {
				$arr = array(
					"message" => "success", 
					"time_stamp_id" => $time_stamp_id, 
					"result" => $result
				);
	
				echo json_encode($arr);
			} else {
				$arr = array(
					"message" => "failed", 
					"time_stamp_id" => $time_stamp_id, 
					"result" => $result
				);
	
				echo json_encode($arr);
			}
		} else {
			$patientData = $this->ModelDashboard->getPatientDataByTsID($time_stamp_id);
			if ($patientData != false) {
				foreach ($patientData as $data) {
					$patientDob = $data->patient_dob;
				}
			}

			$patientDob = new DateTime($patientDob);
			$today = new DateTime('today');

			$y = $today->diff($patientDob)->y;
			$m = $today->diff($patientDob)->m;
			$d = $today->diff($patientDob)->d;
			
			if ($y == 0) {
				if ($m < 3) {
					if ($nadi > "180" && $respirasi > "50" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else {
					if ($nadi > "260" && $respirasi > "40" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
						
						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				}
			} else {
				if ($y > 0 && $y < 3) {
					if ($nadi > "260" && $respirasi > "40" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
						
						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else if ($y >= 3 && $y < 8) {
					if ($nadi > "140" && $respirasi > "30" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				} else {
					if ($nadi > "100" && $respirasi > "20" && $saturasi < "95") {
						$kode_warna = "M";
						$kode_warna2 = "red";
						$lastNoAntrian = $this->ModelDashboard->getLastAntrianMerah();
	
						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "ESI2", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "failed", 
								"time_stamp_id" => $time_stamp_id, 
								"result" => "ESI2"
							);
				
							echo json_encode($arr);
						}
					} else {
						$kode_warna = "";
						$kode_warna2 = "";
						$lastNoAntrian = "";

						$updateTtv = $this->ModelDashboard->updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, "", $kode_warna, $kode_warna2, $lastNoAntrian);
						if ($updateTtv == true) {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						} else {
							$arr = array(
								"message" => "success", 
								"time_stamp_id" => $time_stamp_id, 
								"dekontaminasi" => $dekontaminasi, 
								"doa" => $doa, 
								"result" => ""
							);
				
							echo json_encode($arr);
						}
					}
				}
			}
		}
	}

	public function saveResources() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$dekontaminasi = $this->input->post("dekontaminasi");
		$doa = $this->input->post("doa");
		$ttv = $this->input->post("ttv");
		$resources = $this->input->post("resources");

		if ($resources == "0") {
			$result = "ESI5";
			$kode_warna = "H";
			$kode_warna2 = "green";
			$lastNoAntrian = $this->ModelDashboard->getLastAntrianHijau();
		} else if ($resources == "1") {
			$result = "ESI4";
			$kode_warna = "H";
			$kode_warna2 = "green";
			$lastNoAntrian = $this->ModelDashboard->getLastAntrianHijau();
		} else if ($resources == "2") {
			$result = "ESI3";
			$kode_warna = "K";
			$kode_warna2 = "yellow";
			$lastNoAntrian = $this->ModelDashboard->getLastAntrianKuning();
		}

		$saveResources = $this->ModelDashboard->saveResources($time_stamp_id, $resources, $result, $kode_warna, $kode_warna2, $lastNoAntrian);
		if ($saveResources == true) {
			$arr = array(
				"message" => "success", 
				"time_stamp_id" => $time_stamp_id
			);

			echo json_encode($arr);
		} else {
			$arr = array(
				"message" => "failed", 
				"time_stamp_id" => $time_stamp_id
			);

			echo json_encode($arr);
		}
	}

	public function savePatientCheckup() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientCheckup = $this->ModelDashboard->savePatientCheckup($time_stamp_id, $dttm_update);
		if ($savePatientCheckup == true) {
			echo "successsavepatientcheckup";
		} else {
			echo "failedsavepatient";
		}
	}

	public function savePatientCheckupDpjp() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientCheckupDpjp = $this->ModelDashboard->savePatientCheckupDpjp($time_stamp_id, $dttm_update);
		if ($savePatientCheckupDpjp == true) {
			echo "successsavepatientcheckupdpjp";
		} else {
			echo "failedsavepatient";
		}
	}

	public function savePatientObStart() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientObStart = $this->ModelDashboard->savePatientObStart($time_stamp_id, $dttm_update);
		if ($savePatientObStart == true) {
			echo "successsavepatientobstart";
		} else {
			echo "failedsavepatient";
		}
	}

	public function savePatientObFinish() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientObFinish = $this->ModelDashboard->savePatientObFinish($time_stamp_id, $dttm_update);
		if ($savePatientObFinish == true) {
			echo "successsavepatientobfinish";
		} else {
			echo "failedsavepatient";
		}
	}

	public function savePatientGo() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientGo = $this->ModelDashboard->savePatientGo($time_stamp_id, $dttm_update);
		if ($savePatientGo == true) {
			echo "successsavepatientgo";
		} else {
			echo "failedsavepatient";
		}
	}

	public function savePatientTransfer() {
		$time_stamp_id = $this->input->post("ts_id");
		$dttm_update = date('Y-m-d H:i:s');

		$savePatientTransfer = $this->ModelDashboard->savePatientTransfer($time_stamp_id, $dttm_update);
		if ($savePatientTransfer == true) {
			echo "successsavepatienttransfer";
		} else {
			echo "failedsavepatient";
		}
	}

	public function removePatient() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatient = $this->ModelDashboard->removePatient($time_stamp_id);
		if ($removePatient == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientCome() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientCome = $this->ModelDashboard->removePatientCome($time_stamp_id);
		if ($removePatientCome == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientTriage() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientTriage = $this->ModelDashboard->removePatientTriage($time_stamp_id);
		if ($removePatientTriage == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientCheckup() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientCheckup = $this->ModelDashboard->removePatientCheckup($time_stamp_id);
		if ($removePatientCheckup == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientCheckupDpjp() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientCheckupDpjp = $this->ModelDashboard->removePatientCheckupDpjp($time_stamp_id);
		if ($removePatientCheckupDpjp == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientObstart() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientObstart = $this->ModelDashboard->removePatientObstart($time_stamp_id);
		if ($removePatientObstart == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientObfinish() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientObfinish = $this->ModelDashboard->removePatientObfinish($time_stamp_id);
		if ($removePatientObfinish == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientGo() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientGo = $this->ModelDashboard->removePatientGo($time_stamp_id);
		if ($removePatientGo == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientTransfer() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientTransfer = $this->ModelDashboard->removePatientTransfer($time_stamp_id);
		if ($removePatientTransfer == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function removePatientKhusus() {
		$time_stamp_id = $this->input->post("ts_id");

		$removePatientKhusus = $this->ModelDashboard->removePatientKhusus($time_stamp_id);
		if ($removePatientKhusus == true) {
			echo "successremovepatient";
		} else {
			echo "failedremovepatient";
		}
	}

	public function triage() {
		$data['time_stamp_id'] = $_GET["id"];

		$masterKondisiKritis = $this->ModelDashboard->getMasterKondisiKritis();

		$kondisiKritisByTimeStampId = $this->ModelDashboard->getKondisiKritisByTimeStampId($data['time_stamp_id']);
		if ($kondisiKritisByTimeStampId == "") {
			$data["kondisi_kritis"] = "";
			if ($masterKondisiKritis != false) {
				foreach ($masterKondisiKritis as $row) {
					$data["kondisi_kritis"] .= "<div class='form-check'>
													<input class='form-check-input' type='checkbox' value='".$row->kondisi_kritis_id."' id='".$row->kondisi_kritis_id."' name='kondisi_kritis[]'>
													<label class='form-check-label' for='".$row->kondisi_kritis_id."'>
														".$row->kondisi_kritis_name."
													</label>
												</div>";
				}
			}
			$this->load->view("form_triage.php", $data);
		} else {
			$dataKondisiKritis = $this->ModelDashboard->getDataKondisiKritis($data['time_stamp_id']);

			if ($masterKondisiKritis != false) {
				$data["kondisi_kritis"] = "";
				foreach ($masterKondisiKritis as $row) {
					$c = "";
					foreach ($dataKondisiKritis as $row2) {
						if ($row->kondisi_kritis_id == $row2->kondisi_kritis) {
							$c .= "checked";
						} else {
							$c .= "";
						}
					}

					$data["kondisi_kritis"] .= "<div class='form-check'>
													<input class='form-check-input' type='checkbox' value='".$row->kondisi_kritis_id."' id='".$row->kondisi_kritis_id."' name='kondisi_kritis[]' ".$c.">
													<label class='form-check-label' for='".$row->kondisi_kritis_idx."'>
														".$row->kondisi_kritis_name."
													</label>
												</div>";
				}
			}

			$this->load->view("form_update_kondisi_kritis.php", $data);
		}
	}

	public function ttv() {
		$data['time_stamp_id'] = $_GET["id"];

		$dataTtv = $this->ModelDashboard->getTimeStampTtv($data['time_stamp_id']);
		if ($dataTtv == "") {
			$this->load->view("form_ttv.php", $data);
		} else {
			$getDataTtv = $this->ModelDashboard->getDataTtv($data['time_stamp_id']);
			if ($getDataTtv != false) {
				foreach ($getDataTtv as $row) {
					$data["id"] = $row->id;
					$data["tekanan_darah_sistolik"] = $row->tekanan_darah_sistolik;
					$data["tekanan_darah_diastolik"] = $row->tekanan_darah_diastolik;
					$data["respirasi"] = $row->respirasi;
					$data["saturasi"] = $row->saturasi;
					$data["nadi"] = $row->nadi;
					$data["suhu"] = $row->suhu;
				}
			}
			$this->load->view("form_update_ttv.php", $data);
		}
	}

	public function choosePatientGo() {
		$data["time_stamp_id"] = $_GET["id"];

		$this->load->view("form_patient_go.php", $data);
	}

	public function doa() {
		$data['time_stamp_id'] = $_GET["id"];

		$masterDoa = $this->ModelDashboard->getMasterDoa();
		$data["doa"] = "";
 
		$doaByTimeStampId = $this->ModelDashboard->getDoaByTimeStampId($data['time_stamp_id']);
		if ($doaByTimeStampId == "") {
			if ($masterDoa != false) {
				foreach ($masterDoa as $row) {
					$data["doa"] .= "<div class='form-check'>
										<input class='form-check-input' type='radio' name='death_on_arrival' id='".$row->id."' value='".$row->id."'>
										<label class='form-check-label' for='".$row->id."'>
											".$row->doa_name."
										</label>
									 </div>";
				}
			}
			$this->load->view("form_doa.php", $data);
		} else {
			$dataDoa = $this->ModelDashboard->getDataDoa($data['time_stamp_id']);
			if ($masterDoa != false) {
				foreach ($masterDoa as $row) {
					$c = "";
					foreach ($dataDoa as $row2) {
						if ($row->id === $row2->doa) {
							$c .= "checked";
						} else {
							$c .= "";
						}
					}
					
					$data["doa"] .= "<div class='form-check'>
										<input class='form-check-input' type='radio' name='death_on_arrival' id='".$row->id."' value='".$row->id."' ".$c.">
										<label class='form-check-label' for='".$row->id."'>
											".$row->doa_name."
										</label>
									 </div>";
				}
			}

			$this->load->view("form_update_doa.php", $data);
		}

	}

	public function resources() {
		$data['time_stamp_id'] = $_GET["id"];
		$data['dekontaminasi'] = $_GET["dek"];
		$data['doa'] = $_GET["doa"];
		$data['ttv'] = $_GET["ttv"];
		$this->load->view("form_resources.php");
	}

	public function dekontaminasi() {
		$data['time_stamp_id'] = $_GET["id"];
		$data['result'] = $_GET["result"];
		$this->load->view("form_dekontaminasi.php", $data);
	}

	public function formDataPasien() {
		$data['time_stamp_id'] = $_GET["id"];

		$getPatientByTsID = $this->ModelDashboard->getPatientByTsID($data['time_stamp_id']);
		if ($getPatientByTsID == false) {
			$checkPatientAntrian = $this->ModelDashboard->checkPatientAntrian($data['time_stamp_id']);
			if ($checkPatientAntrian != false) {
				foreach ($checkPatientAntrian as $row) {
					if ($row->time_stamp_id == "") {
							$data['antrian'] = "";
							$data['kode_warna'] = "";

							$data['btnPasienMasuk'] = "";
							$data['btnPanggilAntrian'] = "";
							$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
							$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
							$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
							$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
					} else {
						if ($row->antrian_status == '0') {
							$data['antrian'] = $row->no_antrian;
							$data['kode_warna'] = $row->kode_warna;
	
							$data['btnPasienMasuk'] = "<button type='submit' onclick='pasienMasuk()' class='btn btn-block btn-secondary' style='height:170px;'>Pasien Masuk</button>";
							$data['btnPanggilAntrian'] = "<button type='submit' onclick='panggilAntrian()' class='btn btn-block btn-success' style='height:170px;'>Panggil Antrian</button>";
							$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
							$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
							$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
							$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
						} else {
							$data['antrian'] = $row->no_antrian;
							$data['kode_warna'] = $row->kode_warna;
	
							$data['btnPasienMasuk'] = "";
							$data['btnPanggilAntrian'] = "";
							$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
							$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
							$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
							$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
						}
					}
				}
			} else {
				$data['antrian'] = "";
				$data['kode_warna'] = "";

				$data['btnPasienMasuk'] = "";
				$data['btnPanggilAntrian'] = "";
				$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
				$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
				$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
				$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
			}
		} else {
			$checkPatientAntrian = $this->ModelDashboard->checkPatientAntrian($data['time_stamp_id']);
			if ($checkPatientAntrian != false) {
				foreach ($checkPatientAntrian as $row) {
					if ($row->time_stamp_id == "") {
						$data['antrian'] = "";
						$data['kode_warna'] = "";

						$data['btnPasienMasuk'] = "";
						$data['btnPanggilAntrian'] = "";
						$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
						$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
						$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
						$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
					} else {
						if ($row->antrian_status == '0') {
							$data['antrian'] = $row->no_antrian;
							$data['kode_warna'] = $row->kode_warna;
	
							$data['btnPasienMasuk'] = "<button type='submit' onclick='pasienMasuk()' class='btn btn-block btn-secondary' style='height:170px;'>Pasien Masuk</button>";
							$data['btnPanggilAntrian'] = "<button type='submit' onclick='panggilAntrian()' class='btn btn-block btn-success' style='height:170px;'>Panggil Antrian</button>";
							$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
							$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
							$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
							$data['btnDelete'] = "";
						} else {
							$data['antrian'] = $row->no_antrian;
							$data['kode_warna'] = $row->kode_warna;
	
							$data['btnPasienMasuk'] = "<button type='submit' onclick='pasienMasuk()' class='btn btn-block btn-secondary' style='height:170px;'>Pasien Masuk</button>";
							$data['btnPanggilAntrian'] = "<button type='submit' onclick='panggilAntrian()' class='btn btn-block btn-success' style='height:170px;'>Panggil Antrian</button>";
							$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
							$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
							$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
							$data['btnDelete'] = "";
						}
					}
				}
			} else {
				$data['antrian'] = "";
				$data['kode_warna'] = "";

				$data['btnPasienMasuk'] = "";
				$data['btnPanggilAntrian'] = "";
				$data['btnBatalBerobat'] = "<button type='submit' onclick='batalBerobat()' class='btn btn-block btn-warning' style='height:170px;'>Batal Berobat</button>";
				$data['btnFKTP'] = "<button type='submit' onclick='kembaliFKTP()' class='btn btn-block btn-warning' style='height:170px;'>Kembali ke FKTP</button>";
				$data['btnBerobatPoli'] = "<button type='submit' onclick='berobatPoli()' class='btn btn-block btn-warning' style='height:170px;'>Berobat ke Poliklinik</button>";
				$data['btnDelete'] = "<button type='submit' onclick='deletePatientData()' class='btn btn-block btn-danger' style='height:70px;'>Hapus Pasien</button>";
			}
		}

		$this->load->view("form_data_pasien.php", $data);
	}

	public function pasienMasuk() {
		$time_stamp_id = $this->input->post("time_stamp_id");

		$getDataWarna = $this->ModelDashboard->getDataWarna($time_stamp_id);
		$getNoAntrian = $this->ModelDashboard->getNoAntrian($time_stamp_id);
		if ($getNoAntrian != false) {
			foreach ($getNoAntrian as $row) {
				$no_antrian = $row->no_antrian;
				$antrian_date = $row->antrian_date;
			}
		} else {
			$no_antrian = "";
			$antrian_date = "";
		}
		
		if ($getDataWarna == "M") {
			$checkNoAntrianMerah = $this->ModelDashboard->checkNoAntrianMerah($no_antrian, $antrian_date);
			if ($checkNoAntrianMerah == 0) {
				$updateStatusAntrian = $this->ModelDashboard->updateStatusAntrian($time_stamp_id);
				if ($updateStatusAntrian == true) {
					echo "successupdatestatusantrian";
				} else {
					echo "failedupdatestatusantrian";
					return;
				}
			} else {
				echo "masihadanomorkecil";
				return;
			}
			
		} else if ($getDataWarna == "K") {
			$checkWarnaMerah = $this->ModelDashboard->checkWarnaMerah($antrian_date);
			if ($checkWarnaMerah == 0) {
				$checkNoAntrianKuning = $this->ModelDashboard->checkNoAntrianKuning($no_antrian, $antrian_date);
				if ($checkNoAntrianKuning == 0) {
					$updateStatusAntrian = $this->ModelDashboard->updateStatusAntrian($time_stamp_id);
					if ($updateStatusAntrian == true) {
						echo "successupdatestatusantrian";
					} else {
						echo "failedupdatestatusantrian";
						return;
					}
				} else {
					echo "masihadanomorkecil";
					return;
				}
			} else {
				echo "merahnotempty";
				return;
			}
		} else {
			$checkWarnaMerah = $this->ModelDashboard->checkWarnaMerah($antrian_date);
			if ($checkWarnaMerah == 0) {
				$checkWarnaKuning = $this->ModelDashboard->checkWarnaKuning($antrian_date);
				if ($checkWarnaKuning == 0) {
					$checkNoAntrianHijau = $this->ModelDashboard->checkNoAntrianHijau($no_antrian, $antrian_date);
					if ($checkNoAntrianHijau == 0) {
						$updateStatusAntrian = $this->ModelDashboard->updateStatusAntrian($time_stamp_id);
						if ($updateStatusAntrian == true) {
							echo "successupdatestatusantrian";
						} else {
							echo "failedupdatestatusantrian";
							return;
						}
					} else {
						echo "masihadanomorkecil";
						return;
					}
				} else {
					echo "kuningnotempty";
					return;
				}
			} else {
				echo "merahnotempty";
				return;
			}
		}
	}

	public function pasienDirujuk() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "pasien_dirujuk";

		$pasienDirujuk = $this->ModelDashboard->pasienDirujuk($time_stamp_id, $notes);
		if ($pasienDirujuk == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Pasien berhasil pulang"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal berhasil pulang"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function meninggalDunia() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "meninggal_dunia";

		$meninggalDunia = $this->ModelDashboard->meninggalDunia($time_stamp_id, $notes);
		if ($meninggalDunia == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Pasien berhasil pulang"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal berhasil pulang"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function permintaanSendiri() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "permintaan_sendiri";

		$permintaanSendiri = $this->ModelDashboard->permintaanSendiri($time_stamp_id, $notes);
		if ($permintaanSendiri == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Pasien berhasil pulang"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal berhasil pulang"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function instruksiDokter() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "instruksi_dokter";

		$instruksiDokter = $this->ModelDashboard->instruksiDokter($time_stamp_id, $notes);
		if ($instruksiDokter == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Pasien berhasil pulang"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal berhasil pulang"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function batalBerobat() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "batal_berobat";

		$batalBerobat = $this->ModelDashboard->pasienBatal($time_stamp_id, $notes);
		if ($batalBerobat == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Berhasil menghapus pasien"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal menghapus pasien"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function kembaliFKTP() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "kembali_ke_fktp";

		$kembaliFKTP = $this->ModelDashboard->pasienBatal($time_stamp_id, $notes);
		if ($kembaliFKTP == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Berhasil menghapus pasien"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal menghapus pasien"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function berobatPoli() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$notes = "berobat_ke_poli";

		$kembaliFKTP = $this->ModelDashboard->pasienBatal($time_stamp_id, $notes);
		if ($kembaliFKTP == true) {
			$arr = array(
				"status" => "success", 
				"message" => "Berhasil menghapus pasien"
			); 

			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed", 
				"message" => "Gagal menghapus pasien"
			);

			echo json_encode($arr);
			return;
		}
	}

	public function formUpdateTriage() {
		$data['time_stamp_id'] = $_GET["id"];

		$this->load->view("form_update_triage.php", $data);
	}

	public function formBedPatient() {
		$data['time_stamp_id'] = $this->uri->segment(3);

		$data['listBed'] = "<select class='form-control' id='patient_bed'>
							<option value=''>Select Bed</option>";
		for($i=1; $i<16; $i++){
			$data['listBed'] .= "<option value='".$i."'>".$i."</option>";
		}
		$data['listBed'] .= "</select>";

		$this->load->view("form_bed_pasien.php", $data);
	}

	public function savePatientBedOne() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedTwo() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function checkWarnaAntrian() {
		$time_stamp_id = $this->input->post("time_stamp_id");

		$getDataWarna = $this->ModelDashboard->getDataWarna($time_stamp_id);
		$getNoAntrian = $this->ModelDashboard->getNoAntrian($time_stamp_id);
		if ($getNoAntrian != false) {
			foreach ($getNoAntrian as $row) {
				$no_antrian = $row->no_antrian;
				$antrian_date = $row->antrian_date;
			}
		} else {
			$no_antrian = "";
			$antrian_date = "";
		}

		if ($getDataWarna == "M") {
			$checkNoAntrianMerah = $this->ModelDashboard->checkNoAntrianMerah($no_antrian, $antrian_date);
			if ($checkNoAntrianMerah == 0) {
				echo "success";
			} else {
				echo "masihadanomorkecil";
			}
			echo "success";
		} else if ($getDataWarna == "K") {
			$checkWarnaMerah = $this->ModelDashboard->checkWarnaMerah($antrian_date);
			if ($checkWarnaMerah == 0) {
				$getNoAntrian = $this->ModelDashboard->getNoAntrian($time_stamp_id);

				$checkNoAntrianKuning = $this->ModelDashboard->checkNoAntrianKuning($no_antrian, $antrian_date);
				if ($checkNoAntrianKuning == 0) {
					echo "success";
				} else {
					echo "masihadanomorkecil";
				}
			} else {
				echo "merahnotempty";
				return;
			}
		} else {
			$checkWarnaMerah = $this->ModelDashboard->checkWarnaMerah($antrian_date);
			if ($checkWarnaMerah == 0) {
				$checkWarnaKuning = $this->ModelDashboard->checkWarnaKuning($antrian_date);
				if ($checkWarnaKuning == 0) {
					$getNoAntrian = $this->ModelDashboard->getNoAntrian($time_stamp_id);

					$checkNoAntrianHijau = $this->ModelDashboard->checkNoAntrianHijau($no_antrian, $antrian_date);
					if ($checkNoAntrianHijau == 0) {
						echo "success";
					} else {
						echo "masihadanomorkecil";
					}
				} else {
					echo "kuningnotempty";
					return;
				}
			} else {
				echo "merahnotempty";
				return;
			}
		}
	}

	public function savePatientBedThree() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedFour() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedFive() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedSix() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedSeven() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedEight() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedNine() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedTen() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedResusitasi() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedTindakan() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedPonek() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function savePatientBedIsolasi() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_bed = $this->input->post("patient_bed");

		$checkingBed = $this->ModelDashboard->checkingBed($patient_bed);
		if ($checkingBed == "") {
			$savePatientBed = $this->ModelDashboard->savePatientBed($time_stamp_id, $patient_bed);
			if ($savePatientBed == true) {
				echo "successsavepatientbed";
			} else {
				echo "failedsavepatientbed";
			}
		} else {
			echo "bednotempty";
			return;
		}
	}

	public function checkDataPatient() {
		$patient_mr = $this->input->post("patient_mr");
		$time_stamp_id = $this->input->post("time_stamp_id");

		// $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

		// if ($url == "http://192.168.15.9:1026") {
			$urlTera = "http://192.168.5.5/api.php?mod=api&cmd=get_patient&no_rm=$patient_mr&return_type=json";
		// } else if ($url == "http://192.168.19.21:2300") {
		// 	$urlTera = "http://192.168.19.19/api.php?mod=api&cmd=get_patient&no_rm=$patient_mr&return_type=json";
		// } else if ($url == "http://192.168.5.51") {
		// 	$urlTera = "http://192.168.5.5/api.php?mod=api&cmd=get_patient&no_rm=$patient_mr&return_type=json";
		// } else {
		// 	$urlTera = "http://192.168.15.15/api.php?mod=api&cmd=get_patient&no_rm=$patient_mr&return_type=json";
		// }

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $urlTera,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic cnNjaXB1dHJhOnJzY2lwdXRyYQ==',
    			'Cookie: CIPUTRA=kdro8l3iev6sdarvijnbn4oi27'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		if (isset($response)) {
			$response = json_decode($response);

			if ($response->count == "1" || $response->count == 1) {
				if (strlen($patient_mr) == "1" || strlen($patient_mr) == 1) {
					$ext_patient_mr = "0000000";
				} else if (strlen($patient_mr) == "2" || strlen($patient_mr) == 2) {
					$ext_patient_mr = "000000";
				} else if (strlen($patient_mr) == "3" || strlen($patient_mr) == 3) {
					$ext_patient_mr = "00000";
				} else if (strlen($patient_mr) == "4" || strlen($patient_mr) == 4) {
					$ext_patient_mr = "0000";
				} else if (strlen($patient_mr) == "5" || strlen($patient_mr) == 5) {
					$ext_patient_mr = "000";
				} else if (strlen($patient_mr) == "6" || strlen($patient_mr) == 6) {
					$ext_patient_mr = "00";
				} else if (strlen($patient_mr) == "7" || strlen($patient_mr) == 7) {
					$ext_patient_mr = "0";
				} else {
					$ext_patient_mr = "";
				}

				$patient_mr = $ext_patient_mr.$patient_mr;
				$patient_fullname = $response->data->name_real;
				$patient_dob = $response->data->tgl_lahir;
				$patient_title = $response->data->title;

				echo "<div class='card bg-light text-dark' style='padding:15px 20px 10px 20px;'>
						<table >
							<tr>
								<td style='width:120px;'>Nama Pasien</td>
								<td>
									<input type='hidden' id='patient_mr' value='".$patient_mr."'>
									<input type='hidden' id='patient_fullname' value='".$patient_fullname."'>
									<input type='hidden' id='patient_dob' value='".date("Y-m-d", strtotime($patient_dob))."'>
									<input type='hidden' id='patient_title' value='".$patient_title."'>
									<input type='hidden' id='time_stamp_id' value='".$time_stamp_id."'>
									: <b>".$patient_title." ".$patient_fullname."</b>
								</td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td>: <b>".$patient_dob."</b></td>
							</tr>
							<tr>
								<td >Umur</td>
								<td>: <b>".hitung_umur($patient_dob)."</b></td>
							</tr>
							<tr>
								<td colspan='3'>
									<br>
									<button type='submit' onclick='saveDataPatient()' class='btn btn-block btn-warning'>Simpan</button>
								</td>
							</tr>
						</table>
					</div>";
					
			} else {
				echo "<div class='card bg-danger' style='padding:10px 20px 10px 20px;'>
						<table >
							<tr>
								<td colspan='3' align='center'>
									Data pasien tidak ditemukan
								</td>
							</tr>
						</table>
					</div>";
			}
		} else {
			echo "<div class='card bg-danger' style='padding:10px 20px 10px 20px;'>
					<table >
						<tr>
							<td colspan='3' align='center'>
								Data pasien tidak ditemukan
							</td>
						</tr>
					</table>
				  </div>";
		}
	}

	public function saveDataPatient() {
		$time_stamp_id = $this->input->post("time_stamp_id");
		$patient_mr = $this->input->post("patient_mr");
		$patient_fullname = $this->input->post("patient_fullname");
		$patient_dob = $this->input->post("patient_dob");
		$patient_title = $this->input->post("patient_title");

		$saveDataPatient = $this->ModelDashboard->saveDataPatient($time_stamp_id, $patient_mr, $patient_fullname, $patient_dob, $patient_title);
		if ($saveDataPatient == true) {
			$arr = array(
				"status" => "success",
				"message" => "Berhasil memperbaharui data pasien"
			);
			
			echo json_encode($arr);
			return;
		} else {
			$arr = array(
				"status" => "failed",
				"message" => "Gagal memperbaharui data pasien"
			);
			
			echo json_encode($arr);
			return;
		}
	}

	public function savePatientKhusus() {
		$time_stamp_id = $this->input->post("ts_id");

		$savePatientKhusus = $this->ModelDashboard->savePatientKhusus($time_stamp_id);
		if ($savePatientKhusus == true) {
			echo "successsavepatientkhusus";
		} else {
			echo "failedsavepatientkhusus";
		}
	}

	public function removePatientBed() {
		$time_stamp_id = $this->input->post("time_stamp_id");

		$removePatientBed = $this->ModelDashboard->removePatientBed($time_stamp_id);
		if ($removePatientBed == true) {
			echo "successremovepatientbed";
		} else {
			echo "failedremovepatientbed";
		}
	}

	public function view() {
		$data["listAntrian"] = "";
		$dataAntrian = $this->ModelDashboard->getDataAntrian();
		if ($dataAntrian != false) {
			foreach ($dataAntrian as $row) {
				if ($row->kode_warna == "M") {
					$kode_warna = "Merah";
					$bg = "bg-danger";
					$style = "height:80px;background:red;color:#fff;border-radius:5px;";
				} else if ($row->kode_warna == "H") {
					$kode_warna = "Hijau";
					$bg = "bg-success";
					$style = "height:80px;background:green;color:#fff;border-radius:5px;";
				} else {
					$kode_warna = "Kuning";
					$bg = "bg-warning";
					$style = "height:80px;background:yellow;border-radius:5px;";
				}

				$data["listAntrian"] .= "<div class='col-sm-2' style='padding:4px;'>
											<div class='card ".$bg."' style='".$style."'>
												<div class='card-body' style='text-align:center;padding-top:10px;'>
													<span style='font-size:15px;'>".$kode_warna."</span>
													<h1 style='font-size:45px;;margin-top:-5px;'>".$row->no_antrian."</h1>
												</div>
											</div>
										 </div>";
			}
		}

		$this->load->view("view.php", $data);
	}

	public function view2() {
		$data["listAntrianMerah"] = "";
		$dataAntrianMerah = $this->ModelDashboard->getDataAntrianMerah();
		if ($dataAntrianMerah != false) {
			foreach ($dataAntrianMerah as $row) {
				$data["listAntrianMerah"] .= "<div class='col-sm-12' style='padding:4px;'>
												<div class='card bg-danger' style='height:90px;background:red;color:#fff;border-radius:5px;'>
													<div class='card-body' style='text-align:center;padding-top:10px;'>
														<span style='font-size:15px;'>".date_indo($row->antrian_date)."</span>
														<h1 style='font-size:45px;;margin-top:0px;'>M".$row->no_antrian."</h1>
													</div>
												</div>
											  </div>";
			}
		}

		$data["listAntrianKuning"] = "";
		$dataAntrianKuning = $this->ModelDashboard->getDataAntrianKuning();
		if ($dataAntrianKuning != false) {
			foreach ($dataAntrianKuning as $row) {
				$data["listAntrianKuning"] .= "<div class='col-sm-12' style='padding:4px;'>
												<div class='card bg-warning' style='height:90px;background:yellow;color:#000;border-radius:5px;'>
													<div class='card-body' style='text-align:center;padding-top:10px;'>
														<span style='font-size:15px;'>".date_indo($row->antrian_date)."</span>
														<h1 style='font-size:45px;;margin-top:0px;'>K".$row->no_antrian."</h1>
													</div>
												</div>
											   </div>";
			}
		}
			
		$data["listAntrianHijau"] = "";
		$dataAntrianHijau = $this->ModelDashboard->getDataAntrianHijau();
		if ($dataAntrianHijau != false) {
			foreach ($dataAntrianHijau as $row) {
				$data["listAntrianHijau"] .= "<div class='col-sm-12' style='padding:4px;'>
												<div class='card bg-success' style='height:90px;background:green;color:#fff;border-radius:5px;'>
													<div class='card-body' style='text-align:center;padding-top:10px;'>
														<span style='font-size:15px;'>".date_indo($row->antrian_date)."</span>
														<h1 style='font-size:45px;;margin-top:0px;'>H".$row->no_antrian."</h1>
													</div>
												</div>
											  </div>";
			}
		}

		$this->load->view("view2.php", $data);
	}

	// public function cetak_antrian() {
	// 	$this->load->library('escpos');

	// 	// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
	// 	$profile = CapabilityProfile::load("simple");
	// 	$connector = new WindowsPrintConnector("smb://LAPTOP-18OIUNRE/HP Officejet 7110 series");
	// 	$printer = new Printer($connector, $profile);

	// 	// // membuat objek $printer agar dapat dilakukan fungsinya
	// 	// $printer = new Escpos\Printer($connector);

	// 	// // membuat text biasa | text()
	// 	// $printer->initialize();
	// 	// $printer->text("Ini teks biasa \n");
	// 	// $printer->initialize("\n");

	// 	// select print mode | selectPrintMode() //
	// 	/* Printer::MODE_FONT_A */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_FONT_A);
	// 	// $printer->text("Teks dengan MODE_FONT_A \n");
	// 	// $printer->text("\n");

	// 	// /* Printer::MODE_FONT_B */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_FONT_B);
	// 	// $printer->text("Teks dengan MODE_FONT_B \n");
	// 	// $printer->text("\n");

	// 	// /* Printer::MODE_EMPHASIZED */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
	// 	// $printer->text("Teks dengan MODE_EMPHASIZED \n");
	// 	// $printer->text("\n");

	// 	// /* Printer::MODE_DOUBLE_HEIGHT */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
	// 	// $printer->text("Teks dengan MODE_DOUBLE_HEIGHT \n");
	// 	// $printer->text("\n");

	// 	// /* Printer::MODE_DOUBLE_WIDTH */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_WIDTH);
	// 	// $printer->text("Teks dengan MODE_DOUBLE_WIDTH \n");
	// 	// $printer->text("\n");

	// 	// /* Printer::MODE_UNDERLINE */
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::MODE_UNDERLINE);
	// 	// $printer->text("Teks dengan MODE_UNDERLINE \n");
	// 	// $printer->text("\n");

	// 	// // Teks dengan garis bawah | setUnderline() //
	// 	// $printer->initialize();
	// 	// $printer->selectPrintMode(Escpos\Printer::UNDERLINE_DOUBLE);
	// 	// $printer->text("Ini teks dengan garis bawah \n");
	// 	// $printer->text("\n");

	// 	// // Rata kiri, tengah dan kanan (JUSTIFICATION) | setJustification() //
	// 	// /* Teks rata kiri JUSTIFY_LEFT */
	// 	// $printer->initialize();
	// 	// $printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);
	// 	// $printer->text("Ini teks rata kiri \n");
	// 	// $printer->text("\n");

	// 	// /* Teks rata kiri JUSTIFY_CENTER */
	// 	// $printer->initialize();
	// 	// $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
	// 	// $printer->text("Ini teks rata tengah \n");
	// 	// $printer->text("\n");

	// 	// /* Teks rata kiri JUSTIFY_RIGHT */
	// 	// $printer->initialize();
	// 	// $printer->setJustification(Escpos\Printer::JUSTIFY_RIGHT);
	// 	// $printer->text("Ini teks rata kanan \n");
	// 	// $printer->text("\n");

	// 	// // Font A, B dan C | setFont() //
	// 	// /* Teks dengan font A */
	// 	// $printer->initialize();
	// 	// $printer->setFont(Escpos\Printer::FONT_A);
	// 	// $printer->text("Ini teks dengan font A \n");
	// 	// $printer->text("\n");

	// 	// /* Teks dengan font B */
	// 	// $printer->initialize();
	// 	// $printer->setFont(Escpos\Printer::FONT_B);
	// 	// $printer->text("Ini teks dengan font B \n");
	// 	// $printer->text("\n");

	// 	// /* Teks dengan font C */
	// 	// $printer->initialize();
	// 	// $printer->setFont(Escpos\Printer::FONT_C);
	// 	// $printer->text("Ini teks dengan font C \n");
	// 	// $printer->text("\n");

	// 	// // Jarak perbaris 40 (linespace) | setLineSpacing() //
	// 	// $printer->initialize();
	// 	// $printer->setLineSpacing(40);
	// 	// $printer->text("Ini paragraf dengan \nline spacing sebesar 40 \ndi printer dotmatrix \n");
	// 	// $printer->text("\n");

	// 	// // Jarak dari kiri (Margin Left) | setPrintLeftMargin() //
	// 	// $printer->initialize();
	// 	// $printer->setPrintLeftMargin(10);
	// 	// $printer->text("Ini teks berjarak 10 dari kiri (Nargin Left) \n");
	// 	// $printer->text("\n");

	// 	// // Membalik warna text (background menjadi hitam) | setReverseColors() //
	// 	// $printer->initialize();
	// 	// $printer->setReverseColors(TRUE);
	// 	// $printer->text("Warna teks ini terbalik \n");
	// 	// $printer->text("\n");

	// 	// Menyelesaikan printer //
	// 	// $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat keatas
	// 	// $printer->close();

	// 	// $connector = new NetworkPrintConnector("192.168.91.164"); //Printer/Server IP
	// 	// $printer = new Printer($connector);
	// 	// try {
	// 	// 	// ... Print stuff
	// 	// } finally {
	// 	// 	$printer -> close();
	// 	// }
	// }

	public function cetak_antrian2() {
		$time_stamp_id = $_GET["ts_id"];
		$getNoAntrian = $this->ModelDashboard->getNoAntrian($time_stamp_id);
		$getDataWarna = $this->ModelDashboard->getDataWarna($time_stamp_id);

		$tmpdir = sys_get_temp_dir();
		$file = tempnam($tmpdir, 'ctk');
		$handle = fopen($file, 'w');
		$condensed = Chr(27) . Chr(33) . Chr(4);
		$bold1 = Chr(27) . Chr(69);
		$bold0 = Chr(27) . Chr(70);
		$initialized = chr(27).chr(64);
		$condensed1 = chr(15);
		$condensed0 = chr(18);
		$Data = $initialized;
		$Data .= $condensed1;
		$Data .= "----------------------------\n";
		$Data .= "         Nomor Antrian         \n";
		$Data .= "----------------------------\n";
		$Data .= "<h1>".$getNoAntrian."".$getDataWarna."</h1>\n";
		$Data .= "--------------------------\n";
		$Data .= "<small>Ciputra Hospital - Citra Raya Tangerang</small>\n";
		$Data .= "----------------------------\n";
		fwrite($handle, $Data);
		fclose($handle);
		copy($file, "//192.168.91.164/HP Officejet 7110 series"); # Lakukan cetak
		unlink($file);
	}
}