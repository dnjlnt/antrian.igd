<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class ModelDashboard extends CI_Model {
        public function getTimeStampID() {
			$sql = "SELECT max(time_stamp_id) as maxID FROM t_time_stamp_igd";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "0000";
				} else {
					$getNumberID = (int) substr($maxID, 6, 4);
					$getNumberID = $getNumberID + 1;
				}
				$code = "TSIGD_";
				$timeStampID = $code . sprintf("%04s", $getNumberID);

				return $timeStampID;
			} else {
				return false;
			}
		}

        public function checkingBed($patient_bed) {
			$sql = "select patient_bed from t_time_stamp_igd where patient_bed = '".$patient_bed."' and time_stamp_status = '0'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$patient_bed  = $rows->patient_bed;

				return $patient_bed;
			} else {
				return false;
			}
		}

        public function checkDataPatient($patient_mr) {
            $sql = "select * from t_master_patient where patient_mr = '".$patient_mr."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getPatientByTsID($time_stamp_id) {
            $sql = "select patient_mr from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$patient_mr  = $rows->patient_mr;

				return $patient_mr;
			} else {
				return false;
			}
        }

        public function getPatientDataByTsID($time_stamp_id) {
            $sql = "select * from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function updateDataPatient($time_stamp_id, $nama_pasien, $no_hp, $tanggal_lahir) {
            $sql = "update t_time_stamp_igd set patient_name = '".$nama_pasien."', patient_dob = '".$tanggal_lahir."', patient_phone_number = '".$no_hp."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function checkPatientAntrian($time_stamp_id) {
            $sql = "select * from t_antrian where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataWarna($time_stamp_id) {
            $sql = "select kode_warna from t_antrian where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$kode_warna  = $rows->kode_warna;

				return $kode_warna;
			} else {
				return false;
			}
        }

        public function getNoAntrian($time_stamp_id) {
            $sql = "select no_antrian, antrian_date from t_antrian where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function checkNoAntrianMerah($no_antrian, $antrian_date) {
            $sql = "select count(id) as total from t_antrian where kode_warna = 'M' and antrian_status = '0' and no_antrian < ".$no_antrian." and antrian_date = '".$antrian_date."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total  = $rows->total;

				return $total;
			} else {
				return false;
			}
        }

        public function checkNoAntrianKuning($no_antrian, $antrian_date) {
            $sql = "select count(id) as total from t_antrian where kode_warna = 'K' and antrian_status = '0' and no_antrian < ".$no_antrian." and antrian_date = '".$antrian_date."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total  = $rows->total;

				return $total;
			} else {
				return false;
			}
        }

        public function checkNoAntrianHijau($no_antrian, $antrian_date) {
            $sql = "select count(id) as total from t_antrian where kode_warna = 'H' and antrian_status = '0' and no_antrian < ".$no_antrian." and antrian_date = '".$antrian_date."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total  = $rows->total;

				return $total;
			} else {
				return false;
			}
        }

        public function checkWarnaMerah($antrian_date) {
            $sql = "select count(id) as total from t_antrian where kode_warna = 'M' and antrian_status = '0' and antrian_date = '".$antrian_date."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total  = $rows->total;

				return $total;
			} else {
				return false;
			}
        }

        public function checkWarnaKuning($antrian_date) {
            $sql = "select count(id) as total from t_antrian where kode_warna = 'K' and antrian_status = '0' and antrian_date = '".$antrian_date."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total  = $rows->total;

				return $total;
			} else {
				return false;
			}
        }

        public function getAllPatientIGD() {
            $sql = "select a.*, b.no_antrian, b.kode_warna, b.antrian_status from t_time_stamp_igd as a left join t_antrian as b on b.time_stamp_id = a.time_stamp_id where a.time_stamp_status = '0' order by a.time_stamp_id desc";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function pasienDirujuk($time_stamp_id, $notes) {
            $sql = "update t_time_stamp_igd set patient_go = '".date("Y-m-d H:i:s")."', patient_go_notes = '".$notes."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function meninggalDunia($time_stamp_id, $notes) {
            $sql = "update t_time_stamp_igd set patient_go = '".date("Y-m-d H:i:s")."', patient_go_notes = '".$notes."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function permintaanSendiri($time_stamp_id, $notes) {
            $sql = "update t_time_stamp_igd set patient_go = '".date("Y-m-d H:i:s")."', patient_go_notes = '".$notes."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function instruksiDokter($time_stamp_id, $notes) {
            $sql = "update t_time_stamp_igd set patient_go = '".date("Y-m-d H:i:s")."', patient_go_notes = '".$notes."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function pasienBatal($time_stamp_id, $notes) {
            $sql = "update t_time_stamp_igd set time_stamp_status = '1', patient_notes = '".$notes."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function saveNewPatient($time_stamp_id, $nama_pasien, $no_hp, $tanggal_lahir, $gender, $created_dttm) {
            $sql = "insert into t_time_stamp_igd (time_stamp_id, patient_mr, patient_name, patient_dob, patient_title, patient_gender, patient_phone_number, patient_bed, patient_come, patient_triage, 
                    triage_color, patient_checkup, patient_checkup_dpjp, patient_observation_start, patient_observation_finish, patient_go, patient_transfer, patient_khusus, patient_notes, patient_go_notes,
                    time_stamp_status, created_dttm) values ('".$time_stamp_id."', '', '".$nama_pasien."', '".$tanggal_lahir."', '', '".$gender."', '".$no_hp."', '', '0000-00-00 00:00:00', 
                    '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0', 
                    '".$created_dttm."')";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatient($time_stamp_id, $patient_gender, $created_dttm) {
            $sql = "insert into t_time_stamp_igd (time_stamp_id, patient_mr, patient_name, patient_gender, patient_bed, patient_come, patient_triage, triage_color, patient_checkup, patient_checkup_dpjp, 
                    patient_observation_start, patient_observation_finish, patient_go, patient_transfer, patient_khusus, time_stamp_status, created_dttm) values ('".$time_stamp_id."', '', '', 
                    '".$patient_gender."', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 
                    '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', '".$created_dttm."')";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientCome($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_come = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function getLastAntrianMerah() {
            $sql = "SELECT MAX(CAST(no_antrian as INT)) as maxID from t_antrian where kode_warna = 'M' and antrian_date = '".date("Y-m-d")."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "1";
				} else {
					$getNumberID = $maxID + 1;
				}

				return $getNumberID;
			} else {
				return false;
			}
        }

        public function getLastAntrianKuning() {
            $sql = "SELECT MAX(CAST(no_antrian as INT)) as maxID FROM t_antrian where kode_warna = 'K' and antrian_date = '".date("Y-m-d")."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "1";
				} else {
					$getNumberID = $maxID + 1;
				}

				return $getNumberID;
			} else {
				return false;
			}
        }

        public function getLastAntrianHijau() {
            $sql = "SELECT MAX(CAST(no_antrian as INT)) as maxID FROM t_antrian where kode_warna = 'H' and antrian_date = '".date("Y-m-d")."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "1";
				} else {
					$getNumberID = $maxID + 1;
				}

				return $getNumberID;
			} else {
				return false;
			}
        }

        public function saveTriageRed($time_stamp_id, $lastNoAntrianMerah, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_triage = '".$dttm_update."', triage_color = 'red' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id."', 'M', '".$lastNoAntrianMerah."', '0', '".date("Y-m-d")."')";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateTriageRed($time_stamp_id, $lastNoAntrianMerah) {
            $sql = "update t_time_stamp_igd set triage_color = 'red' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set kode_warna = 'M', no_antrian = '".$lastNoAntrianMerah."', antrian_status = '0' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function saveTriageYellow($time_stamp_id, $lastNoAntrianKuning, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_triage = '".$dttm_update."', triage_color = 'yellow' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id."', 'K', '".$lastNoAntrianKuning."', '0', 
                        '".date("Y-m-d")."')";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateTriageYellow($time_stamp_id, $lastNoAntrianKuning) {
            $sql = "update t_time_stamp_igd set triage_color = 'yellow' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set kode_warna = 'K', no_antrian = '".$lastNoAntrianKuning."', antrian_status = '0' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function saveTriageGreen($time_stamp_id, $lastNoAntrianHijau, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_triage = '".$dttm_update."', triage_color = 'green' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id."', 'H', '".$lastNoAntrianHijau."', '0', '".date("Y-m-d")."')";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateTriageGreen($time_stamp_id, $lastNoAntrianHijau) {
            $sql = "update t_time_stamp_igd set triage_color = 'green' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set kode_warna = 'H', no_antrian = '".$lastNoAntrianHijau."', antrian_status = '0' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateStatusAntrian($time_stamp_id) {
            $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function saveTriageBlack($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_triage = '".$dttm_update."', triage_color = 'black' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function updateTriageBlack($time_stamp_id) {
            $sql = "update t_time_stamp_igd set triage_color = 'black' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientCheckup($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_checkup = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientCheckupDpjp($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_checkup_dpjp = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientObStart($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_observation_start = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientObFinish($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_observation_finish = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientGo($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_go = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientTransfer($time_stamp_id, $dttm_update) {
            $sql = "update t_time_stamp_igd set patient_transfer = '".$dttm_update."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientKhusus($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_khusus = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatient($time_stamp_id) {
            $sql = "update t_time_stamp_igd set time_stamp_status = '1' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function removePatientCome($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_come = '', patient_triage = '', triage_color = '', patient_checkup = '', patient_observation_start = '', patient_observation_finish = '', 
                    patient_go = '', patient_go_notes = '', patient_transfer = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function removePatientTriage($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_triage = '', triage_color = '', patient_checkup = '', patient_observation_start = '', patient_observation_finish = '', patient_go = '', patient_go_notes = '',
                    patient_transfer = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function removePatientCheckup($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_checkup = '', patient_checkup_dpjp = '', patient_observation_start = '', patient_observation_finish = '', patient_go = '', patient_transfer = '', patient_go_notes = '', 
                    where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function getNotes($time_stamp_id) {
            $sql = "select id, notes from t_notes where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getNotesByID($notes_id) {
            $sql = "select a.id, a.time_stamp_id, a.notes, b.patient_khusus from t_notes as a left join t_time_stamp_igd as b on b.time_stamp_id = a.time_stamp_id where a.id = '".$notes_id."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function saveNotes($ts_id, $notes) {
            $sql = "insert into t_notes (time_stamp_id, notes) values ('".$ts_id."', '".$notes."')";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function saveEditNotes($notes_id, $notes) {
            $sql = "update t_notes set notes = '".$notes."' where id = '".$notes_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientCheckupDpjp($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_checkup_dpjp = '', patient_observation_start = '', patient_observation_finish = '', patient_go = '', patient_go_notes = '', patient_transfer = '' where 
                    time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientObstart($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_observation_start = '', patient_observation_finish = '', patient_go = '', patient_go_notes = '', patient_transfer = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientObfinish($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_observation_finish = '', patient_go = '', patient_go_notes = '', patient_transfer = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientGo($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_go = '', patient_go_notes = '', patient_transfer = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientTransfer($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_transfer = '', patient_go = '', patient_go_notes = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function savePatientBed($time_stamp_id, $patient_bed) {
            $sql = "update t_time_stamp_igd set patient_bed = '".$patient_bed."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function saveDataPatient($time_stamp_id, $patient_mr, $patient_fullname, $patient_dob, $patient_title) {
            $sql = "update t_time_stamp_igd set patient_mr = '".$patient_mr."', patient_name = '".$patient_fullname."', patient_dob = '".$patient_dob."', patient_title = '".$patient_title."' where 
                    time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function getDataReport($from_date, $to_date) {
            $sql = "select a.*, b.result from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where (date(a.patient_come) between '".$from_date."' and '".$to_date."') and (a.patient_mr is not null and a.patient_name is not null 
                    and a.patient_dob is not null); ";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getTotalPasienPulang($from_date, $to_date) {
            $sql = "select count(a.time_stamp_id) as total_pasien_pulang from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where a.patient_go != '0000-00-00 00:00:00' and (date(a.patient_come) between '".$from_date."' and 
                    '".$to_date."')";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_pasien_pulang  = $rows->total_pasien_pulang;

				return $total_pasien_pulang;
			} else {
				return false;
			}
        }

        public function getTotalPasienRanap($from_date, $to_date) {
            $sql = "select count(time_stamp_id) as total_pasien_ranap from t_time_stamp_igd where patient_transfer != '0000-00-00 00:00:00' and (date(patient_come) between '".$from_date."' and '".$to_date."')";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_pasien_ranap  = $rows->total_pasien_ranap;

				return $total_pasien_ranap;
			} else {
				return false;
			}
        }

        public function getTotalPasienKhusus($from_date, $to_date) {
            $sql = "select count(time_stamp_id) as total_pasien_khusus from t_time_stamp_igd where patient_khusus = '1' and (date(patient_come) between '".$from_date."' and '".$to_date."')";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_pasien_khusus  = $rows->total_pasien_khusus;

				return $total_pasien_khusus;
			} else {
				return false;
			}
        }

        public function getTotalTriageBlack($from_date, $to_date) {
            // $sql = "select COUNT(triage_color) as total_triage_black from t_time_stamp_igd where (date(patient_come) between '".$from_date."' and '".$to_date."') and (patient_mr is not null and 
            //         patient_name is not null and patient_dob is not null) and triage_color = 'black'";
                    
            $sql = "select count(a.triage_color) as total_triage_black from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where (date(a.patient_come) between '".$from_date."' and '".$to_date."') and a.triage_color = 'black' 
                    and a.patient_notes != 'Ubah Triage'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_triage_black  = $rows->total_triage_black;

				return $total_triage_black;
			} else {
				return false;
			}
        }

        public function getTotalTriageRed($from_date, $to_date) {
            // $sql = "select COUNT(triage_color) as total_triage_red from t_time_stamp_igd where (date(patient_come) between '".$from_date."' and '".$to_date."') and (patient_mr is not null and 
            //         patient_name is not null and patient_dob is not null) and triage_color = 'red'";

            $sql = "select count(a.triage_color) as total_triage_red from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where (date(a.patient_come) between '".$from_date."' and '".$to_date."') and a.triage_color = 'red' 
                    and a.patient_notes != 'Ubah Triage'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_triage_red  = $rows->total_triage_red;

				return $total_triage_red;
			} else {
				return false;
			}
        }

        public function getTotalTriageYellow($from_date, $to_date) {
            // $sql = "select COUNT(triage_color) as total_triage_yellow from t_time_stamp_igd where (date(patient_come) between '".$from_date."' and '".$to_date."') and (patient_mr is not null and 
            //         patient_name is not null and patient_dob is not null) and triage_color = 'yellow'";

            $sql = "select count(a.triage_color) as total_triage_yellow from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where (date(a.patient_come) between '".$from_date."' and '".$to_date."') and a.triage_color = 'yellow' 
                    and a.patient_notes != 'Ubah Triage'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_triage_yellow  = $rows->total_triage_yellow;

				return $total_triage_yellow;
			} else {
				return false;
			}
        }

        public function getTotalTriageGreen($from_date, $to_date) {
            // $sql = "select COUNT(triage_color) as total_triage_green from t_time_stamp_igd where (date(patient_come) between '".$from_date."' and '".$to_date."') and (patient_mr is not null and patient_name is not null and patient_dob is not null) and 
            //         triage_color = 'green'";

            $sql = "select count(a.triage_color) as total_triage_green from t_time_stamp_igd as a left join t_result as b on b.time_stamp_id = a.time_stamp_id where (date(a.patient_come) between '".$from_date."' and '".$to_date."') and a.triage_color = 'green' 
                    and a.patient_notes != 'Ubah Triage'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$total_triage_green  = $rows->total_triage_green;

				return $total_triage_green;
			} else {
				return false;
			}
        }


        public function getColorTriage($time_stamp_id) {
            $sql = "select triage_color from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$triage_color  = $rows->triage_color;

				return $triage_color;
			} else {
				return false;
			}
        }

        public function getTimeStampTtv($time_stamp_id) {
            $sql = "select time_stamp_id from t_ttv where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows = $query->row();
				$time_stamp_id = $rows->time_stamp_id;

				return $time_stamp_id;
			} else {
				return false;
			}
        }

        public function getDataTtv($time_stamp_id) {
            $sql = "select * from t_ttv where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataTimeReport($from_date, $to_date) {
            $sql = "select time_stamp_id, patient_mr, patient_name, patient_dob, patient_title, patient_gender, patient_bed, patient_come, patient_khusus, timediff(patient_triage, patient_come) as 
                    come_triage_time, timediff(patient_checkup, patient_triage) as triage_checkup_time, timediff(patient_checkup_dpjp, patient_checkup) as checkup_checkupdpjp_time, 
                    timediff(patient_observation_start, patient_checkup_dpjp) as checkupdpjp_obstart_time, timediff(patient_observation_finish, patient_observation_start) as obstart_obfinish_time,
                    timediff(patient_go, patient_observation_finish) as obfinish_obgo_time, timediff(patient_transfer, patient_observation_finish) as obfinish_obtransfer_time from t_time_stamp_igd 
                    where (date(patient_come) between '".$from_date."' and '".$to_date."') and (patient_mr is not null and patient_name is not null and patient_dob is not null); ";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function deletePatientData($time_stamp_id) {
            $sql = "delete from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "delete from t_antrian where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function savePatientKhusus($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_khusus = '1' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function removePatientBed($time_stamp_id) {
            $sql = "update t_time_stamp_igd set patient_bed = '' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function getDataAntrian() {
            $sql = "select * from t_antrian where antrian_status = '0' order by kode_warna desc, no_antrian + 0 asc";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataAntrianMerah() {
            $sql = "select * from t_antrian where antrian_status = '0' and kode_warna = 'M' order by kode_warna desc, no_antrian + 0 asc";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataAntrianKuning() {
            $sql = "select * from t_antrian where antrian_status = '0' and kode_warna = 'K' order by kode_warna desc, no_antrian + 0 asc";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataAntrianHijau() {
            $sql = "select * from t_antrian where antrian_status = '0' and kode_warna = 'H' order by kode_warna desc, no_antrian + 0 asc";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function saveTtm($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, $result, $kode_warna, $kode_warna2, $lastNoAntrian) {
            if ($result == "") {
                $sql = "insert into t_ttv (time_stamp_id, tekanan_darah_sistolik, tekanan_darah_diastolik, respirasi, saturasi, nadi, suhu) values ('".$time_stamp_id."', '".$tekanan_darah_sistolik."', '".$tekanan_darah_diastolik."', '".$respirasi."', 
                        '".$saturasi."', '".$nadi."', '".$suhu."')";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $sql = "update t_time_stamp_igd set patient_triage = '".date("Y-m-d H:i:s")."', triage_color = '".$kode_warna2."' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {

                    $sql = "insert into t_ttv (time_stamp_id, tekanan_darah_sistolik, tekanan_darah_diastolik, respirasi, saturasi, nadi, suhu) values ('".$time_stamp_id."', '".$tekanan_darah_sistolik."', '".$tekanan_darah_diastolik."', '".$respirasi."', 
                            '".$saturasi."', '".$nadi."', '".$suhu."')";
                    $query = $this->db->query($sql);
                    if ($query) {
                        $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id."', '".$kode_warna."', '".$lastNoAntrian."', '0', '".date("Y-m-d H:i:s")."')";
                        $query = $this->db->query($sql);
                        if ($query) {
                            $sql = "insert into t_resources (time_stamp_id, resources) values ('".$time_stamp_id."', '')";
                            $query = $this->db->query($sql);
                            if ($query) {
                                $sql = "insert into t_result (time_stamp_id, result) values ('".$time_stamp_id."', '".$result."')";
                                $query = $this->db->query($sql);
                                if ($query) {
                                    return true;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        public function updateTtv($time_stamp_id, $tekanan_darah_sistolik, $tekanan_darah_diastolik, $respirasi, $saturasi, $nadi, $suhu, $result, $kode_warna, $kode_warna2, $lastNoAntrian) {
            if ($result == "") {
                $sql = "update t_ttv set tekanan_darah_sistolik = '".$tekanan_darah_sistolik."', tekanan_darah_diastolik = '".$tekanan_darah_diastolik."', respirasi = '".$respirasi."', saturasi = '".$saturasi."', 
                        nadi = '".$nadi."', suhu = '".$suhu."' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $sql = "select time_stamp_id from t_antrian where time_stamp_id = '".$time_stamp_id."' and antrian_status = '0'";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $rows = $query->row();
                    $time_stamp_id_db1 = $rows->time_stamp_id;
                } else {
                    $time_stamp_id_db1 = "";
                }

                if ($time_stamp_id_db1 != "") {
                    $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                    $this->db->query($sql);
                }

                $sql = "select time_stamp_id from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."' and time_stamp_status = '0' and triage_color is not null";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $rows = $query->row();
                    $time_stamp_id_db2 = $rows->time_stamp_id;
                } else {
                    $time_stamp_id_db2 = "";
                }

                if ($time_stamp_id_db2 != "") {
                    $sql = "update t_time_stamp_igd set time_stamp_status = '1', patient_notes = 'Ubah Triage' where time_stamp_id = '".$time_stamp_id."'";
                    $query = $this->db->query($sql);
    
                    if ($query) {
                        $sql = "select 
                                    a.patient_mr, a.patient_name, a.patient_dob, a.patient_title, a.patient_gender, a.patient_phone_number, a.patient_come, 
                                    b.doa, 
                                    c.dekontaminasi,
                                    d. tekanan_darah_sistolik, d.tekanan_darah_diastolik, d.respirasi, d.saturasi, d.nadi, d.suhu
                                from t_time_stamp_igd as a 
                                    left join t_doa as b on b.time_stamp_id = a.time_stamp_id 
                                    left join t_dekontaminasi as c on c.time_stamp_id = a.time_stamp_id 
                                    left join t_ttv as d on d.time_stamp_id = a.time_stamp_id 
                                where a.time_stamp_id = '".$time_stamp_id."'";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result() as $row) {
                                $patient_mr = $row->patient_mr;
                                $patient_name = $row->patient_name;
                                $patient_dob = $row->patient_dob;
                                $patient_title = $row->patient_title;
                                $patient_gender = $row->patient_gender;
                                $patient_phone_number = $row->patient_phone_number;
                                $patient_come = $row->patient_come;
                                $doa = $row->doa;
                                $dekontaminasi = $row->doa;
                                $tekanan_darah_sistolik = $row->tekanan_darah_sistolik;
                                $tekanan_darah_diastolik = $row->tekanan_darah_diastolik;
                                $respirasi = $row->respirasi;
                                $saturasi = $row->saturasi;
                                $nadi = $row->nadi;
                                $suhu = $row->suhu;
                            }
                        } else {
                            $patient_mr = "";
                            $patient_name = "";
                            $patient_dob = "";
                            $patient_title = "";
                            $patient_gender = "";
                            $patient_phone_number = "";
                            $patient_come = "";
                            $doa = "";
                            $dekontaminasi = "";
                            $tekanan_darah_sistolik = "";
                            $tekanan_darah_diastolik = "";
                            $respirasi = "";
                            $saturasi = "";
                            $nadi = "";
                            $suhu = "";
                        }
    
                        $time_stamp_id_new = uniqid();
    
                        $sql = "select * from t_kondisi_kritis where time_stamp_id = '".$time_stamp_id."'";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                            foreach($query->result() as $row) {
                                $sql = "insert into t_kondisi_kritis (time_stamp_id, kondisi_kritis) values ('".$time_stamp_id_new."', '".$row->kondisi_kritis."')";
                                $query = $this->db->query($sql);
                            }
                        }
            
                        $sql = "insert into t_time_stamp_igd (time_stamp_id, patient_mr, patient_name, patient_dob, patient_title, patient_gender, patient_phone_number, patient_bed, patient_come, patient_triage, triage_color, patient_checkup, 
                                patient_checkup_dpjp, patient_observation_start, patient_observation_finish, patient_go, patient_transfer, patient_khusus, patient_notes, patient_go_notes, time_stamp_status, created_dttm) values ('".$time_stamp_id_new."', 
                                '".$patient_mr."', '".$patient_name."', '".$patient_dob."', '".$patient_title."', '".$patient_gender."', '".$patient_phone_number."', '', '".$patient_come."', '".date("Y-m-d H:i:s")."', '".$kode_warna2."', '0000-00-00 00:00:00', 
                                '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0', '".date("Y-m-d H:i:s")."')";
                        $query = $this->db->query($sql);
                        if ($query) {
                            $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id_new."', '".$kode_warna."', '".$lastNoAntrian."', '0', '".date("Y-m-d H:i:s")."')";
                            $query = $this->db->query($sql);
                            if ($query) {
                                $sql = "insert into t_resources (time_stamp_id, resources) values ('".$time_stamp_id_new."', '')";
                                $query = $this->db->query($sql);
                                if ($query) {
                                    $sql = "insert into t_result (time_stamp_id, result) values ('".$time_stamp_id_new."', '".$result."')";
                                    $query = $this->db->query($sql);
                                    if ($query) {
                                        $sql = "insert into t_doa (time_stamp_id, doa) values ('".$time_stamp_id_new."', '".$doa."')";
                                        $query = $this->db->query($sql);
                                        if ($query) {
                                            $sql = "insert into t_dekontaminasi (time_stamp_id, dekontaminasi) values ('".$time_stamp_id_new."', '".$dekontaminasi."')";
                                            $query = $this->db->query($sql);
                                            if ($query) {
                                                $sql = "insert into t_ttv (time_stamp_id, tekanan_darah_sistolik, tekanan_darah_diastolik, respirasi, saturasi, nadi, suhu) values ('".$time_stamp_id_new."', '".$tekanan_darah_sistolik."', 
                                                        '".$tekanan_darah_diastolik."', '".$respirasi."', '".$saturasi."', '".$nadi."', '".$suhu."')";
                                                $query = $this->db->query($sql);
                                                if ($query) {
                                                    return true;
                                                } else {
                                                    return false;
                                                }
                                            } else {
                                                return false;
                                            }
                                        } else {
                                            return false;
                                        }
                                    } else {
                                        return false;
                                    }
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    $sql = "update t_time_stamp_igd set patient_triage = '".date("Y-m-d H:i:s")."', triage_color = '".$kode_warna2."' where time_stamp_id = '".$time_stamp_id."'";
                    $query = $this->db->query($sql);
                    if ($query) {
                        return true;
                    } else {
                        return false;
                    }
                }  
            }
        }

        public function saveResources($time_stamp_id, $resources, $result, $kode_warna, $kode_warna2, $lastNoAntrian) {
            $sql = "select time_stamp_id from t_antrian where time_stamp_id = '".$time_stamp_id."' and antrian_status = '0'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $rows = $query->row();
                $time_stamp_id_db1 = $rows->time_stamp_id;
            } else {
                $time_stamp_id_db1 = "";
            }

            if ($time_stamp_id_db1 != "") {
                $sql = "update t_antrian set antrian_status = '1' where time_stamp_id = '".$time_stamp_id."'";
                $this->db->query($sql);
            }

            $sql = "select time_stamp_id from t_time_stamp_igd where time_stamp_id = '".$time_stamp_id."' and time_stamp_status = '0' and triage_color != ''";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $rows = $query->row();
                $time_stamp_id_db2 = $rows->time_stamp_id;
            } else {
                $time_stamp_id_db2 = "";
            }

            if ($time_stamp_id_db2 != "") {
                $sql = "update t_time_stamp_igd set time_stamp_status = '1', patient_notes = 'Ubah Triage' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);

                if ($query) {
                    $sql = "select 
                                a.patient_mr, a.patient_name, a.patient_dob, a.patient_title, a.patient_gender, a.patient_phone_number, a.patient_come, 
                                b.doa, 
                                c.dekontaminasi,
                                d. tekanan_darah_sistolik, d.tekanan_darah_diastolik, d.respirasi, d.saturasi, d.nadi, d.suhu
                            from t_time_stamp_igd as a 
                                left join t_doa as b on b.time_stamp_id = a.time_stamp_id 
                                left join t_dekontaminasi as c on c.time_stamp_id = a.time_stamp_id 
                                left join t_ttv as d on d.time_stamp_id = a.time_stamp_id 
                            where a.time_stamp_id = '".$time_stamp_id."'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result() as $row) {
                            $patient_mr = $row->patient_mr;
                            $patient_name = $row->patient_name;
                            $patient_dob = $row->patient_dob;
                            $patient_title = $row->patient_title;
                            $patient_gender = $row->patient_gender;
                            $patient_phone_number = $row->patient_phone_number;
                            $patient_come = $row->patient_come;
                            $doa = $row->doa;
                            $dekontaminasi = $row->doa;
                            $tekanan_darah_sistolik = $row->tekanan_darah_sistolik;
                            $tekanan_darah_diastolik = $row->tekanan_darah_diastolik;
                            $respirasi = $row->respirasi;
                            $saturasi = $row->saturasi;
                            $nadi = $row->nadi;
                            $suhu = $row->suhu;
                        }
                    } else {
                        $patient_mr = "";
                        $patient_name = "";
                        $patient_dob = "";
                        $patient_title = "";
                        $patient_gender = "";
                        $patient_phone_number = "";
                        $patient_come = "";
                        $doa = "";
                        $dekontaminasi = "";
                        $tekanan_darah_sistolik = "";
                        $tekanan_darah_diastolik = "";
                        $respirasi = "";
                        $saturasi = "";
                        $nadi = "";
                        $suhu = "";
                    }

                    $time_stamp_id_new = uniqid();

                    $sql = "select * from t_kondisi_kritis where time_stamp_id = '".$time_stamp_id."'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach($query->result() as $row) {
                            $sql = "insert into t_kondisi_kritis (time_stamp_id, kondisi_kritis) values ('".$time_stamp_id_new."', '".$row->kondisi_kritis."')";
                            $query = $this->db->query($sql);
                        }
                    }
                
                    $sql = "insert into t_time_stamp_igd (time_stamp_id, patient_mr, patient_name, patient_dob, patient_title, patient_gender, patient_phone_number, patient_bed, patient_come, patient_triage, triage_color, patient_checkup, patient_checkup_dpjp, 
                            patient_observation_start, patient_observation_finish, patient_go, patient_transfer, patient_khusus, patient_notes, patient_go_notes, time_stamp_status, created_dttm) values ('".$time_stamp_id_new."', '".$patient_mr."', 
                            '".$patient_name."', '".$patient_dob."', '".$patient_title."', '".$patient_gender."', '".$patient_phone_number."', '', '".$patient_come."', '".date("Y-m-d H:i:s")."', '".$kode_warna2."', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 
                            '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0', '".date("Y-m-d H:i:s")."')";
                    $query = $this->db->query($sql);
                    if ($query) {
                        $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id_new."', '".$kode_warna."', '".$lastNoAntrian."', '0', '".date("Y-m-d H:i:s")."')";
                        $query = $this->db->query($sql);
                        if ($query) {
                            $sql = "insert into t_resources (time_stamp_id, resources) values ('".$time_stamp_id_new."', '".$resources."')";
                            $query = $this->db->query($sql);
                            if ($query) {
                                $sql = "insert into t_result (time_stamp_id, result) values ('".$time_stamp_id_new."', '".$result."')";
                                $query = $this->db->query($sql);
                                if ($query) {
                                    $sql = "insert into t_doa (time_stamp_id, doa) values ('".$time_stamp_id_new."', '".$doa."')";
                                    $query = $this->db->query($sql);
                                    if ($query) {
                                        $sql = "insert into t_dekontaminasi (time_stamp_id, dekontaminasi) values ('".$time_stamp_id_new."', '".$dekontaminasi."')";
                                        $query = $this->db->query($sql);
                                        if ($query) {
                                            $sql = "insert into t_ttv (time_stamp_id, tekanan_darah_sistolik, tekanan_darah_diastolik, respirasi, saturasi, nadi, suhu) values ('".$time_stamp_id_new."', '".$tekanan_darah_sistolik."', 
                                                    '".$tekanan_darah_diastolik."', '".$respirasi."', '".$saturasi."', '".$nadi."', '".$suhu."')";
                                            $query = $this->db->query($sql);
                                            if ($query) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                        } else {
                                            return false;
                                        }
                                    } else {
                                        return false;
                                    }
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                } 
            } else {
                $sql = "update t_time_stamp_igd set patient_triage = '".date("Y-m-d H:i:s")."', triage_color = '".$kode_warna2."' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    $sql = "insert into t_antrian (time_stamp_id, kode_warna, no_antrian, antrian_status, antrian_date) values ('".$time_stamp_id."', '".$kode_warna."', '".$lastNoAntrian."', '0', '".date("Y-m-d H:i:s")."')";
                        $query = $this->db->query($sql);
                        if ($query) {
                            $sql = "insert into t_resources (time_stamp_id, resources) values ('".$time_stamp_id."', '".$resources."')";
                            $query = $this->db->query($sql);
                            if ($query) {
                                $sql = "insert into t_result (time_stamp_id, result) values ('".$time_stamp_id."', '".$result."')";
                                $query = $this->db->query($sql);
                                if ($query) {
                                    return true;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                } else {
                    return false;
                }
 
            }
        }

        public function saveDoa($time_stamp_id, $death_on_arrival, $kode_warna, $dekontaminasi) {
            $sql = "insert into t_doa (time_stamp_id, doa) values ('".$time_stamp_id."', '".$death_on_arrival."')";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "insert into t_dekontaminasi (time_stamp_id, dekontaminasi) values ('".$time_stamp_id."', '".$dekontaminasi."')";
                $query = $this->db->query($sql);
                if ($query) {
                    if ($death_on_arrival == "0") {
                        return true;
                    } else {
                        $sql = "update t_time_stamp_igd set patient_triage = '".date("Y-m-d H:i:s")."', triage_color = '".$kode_warna."' where time_stamp_id = '".$time_stamp_id."'";
                        $query = $this->db->query($sql);
                        if ($query) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {  
                return false;
            }
        }

        public function updateDoa($time_stamp_id, $death_on_arrival, $kode_warna, $dekontaminasi) {
            $sql = "update t_doa set doa = '".$death_on_arrival."' where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                $sql = "update t_dekontaminasi set dekontaminasi = '".$dekontaminasi."' where time_stamp_id = '".$time_stamp_id."'";
                $query = $this->db->query($sql);
                if ($query) {
                    if ($death_on_arrival == "0") {
                        return true;
                    } else {
                        $sql = "update t_time_stamp_igd set patient_triage = '".date("Y-m-d H:i:s")."', triage_color = '".$kode_warna."' where time_stamp_id = '".$time_stamp_id."'";
                        $query = $this->db->query($sql);
                        if ($query) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {  
                return false;
            }
        }

        public function saveKondisiKritis($time_stamp_id, $kondisi_kritis) {
            foreach ($kondisi_kritis as $row) {
                $sql = "insert into t_kondisi_kritis (time_stamp_id, kondisi_kritis) values ('".$time_stamp_id."', '".$row."')";
                $query = $this->db->query($sql);
            }

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function updateKondisiKritis($time_stamp_id, $kondisi_kritis) {
            $sql = "delete from t_kondisi_kritis where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
            if ($query) {
                foreach ($kondisi_kritis as $row) {
                    $sql = "insert into t_kondisi_kritis (time_stamp_id, kondisi_kritis) values ('".$time_stamp_id."', '".$row."')";
                    $query = $this->db->query($sql);
                }
    
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function getKondisiKritisByTimeStampId($time_stamp_id) {
            $sql = "select time_stamp_id from t_kondisi_kritis where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows = $query->row();
				$time_stamp_id = $rows->time_stamp_id;

				return $time_stamp_id;
			} else {
				return false;
			}
        }

        public function getDataKondisiKritis($time_stamp_id) {
            $sql = "select * from t_kondisi_kritis where time_stamp_id = '".$time_stamp_id."'";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getMasterKondisiKritis() {
            $sql = "select * from t_master_kondisi_kritis";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getMasterDoa() {
            $sql = "select * from t_master_doa";
            $query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDoaByTimeStampId($time_stamp_id) {
            $sql = "select time_stamp_id from t_doa where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows = $query->row();
				$time_stamp_id = $rows->time_stamp_id;

				return $time_stamp_id;
			} else {
				return false;
			}
        }

        public function getDataDoa($time_stamp_id) {
            $sql = "select * from t_doa where time_stamp_id = '".$time_stamp_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getDataTtvReport($from_date, $to_date) {
            $sql = "select a.patient_name, a.patient_mr, a.patient_dob, a.patient_gender, b.tekanan_darah_sistolik, b.tekanan_darah_diastolik, b.respirasi, b.saturasi, b.nadi, b.suhu, a.patient_notes 
                    from t_time_stamp_igd as a left join t_ttv as b on b.time_stamp_id = a.time_stamp_id where date(a.patient_come) >= '".$from_date."' and date(a.patient_come) <= '".$to_date."' and 
                    a.patient_notes != 'Ubah Triage'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }
	}
?>
