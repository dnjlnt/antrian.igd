<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class ModelAuth extends CI_Model {
		public function getAllUnit() {
			$sql = "select * from t_m_unit where unit_status = '0'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}

        public function getAllDepartment($unit_id) {
			$sql = "select * from t_m_department where unit_id = '".$unit_id."' and department_status = '0'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}

        public function getAllPosition() {
			$sql = "select * from t_m_position where position_status = '0'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}

		public function getUserID() {
			$sql = "SELECT max(user_id) as maxID FROM t_master_user";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "000";
				} else {
					$getNumberID = (int) substr($maxID, 5, 3);
					$getNumberID = $getNumberID + 1;
				}
				$code = "USER_";
				$getUserID = $code . sprintf("%03s", $getNumberID);

				return $getUserID;
			} else {
				return false;
			}
		}

		public function saveUserData($data) {
			$sql = "insert into t_master_user (user_id, username, password, last_login, last_logout, created_by, created_dttm) value 
					('".$data['user_id']."', '".$data['user_username']."', '".$data['user_password']."', '', '', 
					'".$data['created_by']."', '".$data['created_dttm']."')";
			$query = $this->db->query($sql);
			if ($query) {
				$sql = "insert into t_detail_user (user_id, user_fullname, user_email, user_hp, user_unit, user_department, user_position, 
						created_by, created_dttm) value ('".$data['user_id']."', '".$data['user_fullname']."', '".$data['user_email']."', 
						'".$data['user_hp']."', '".$data['user_unit']."', '".$data['user_department']."', '".$data['user_position']."', 
						'".$data['created_by']."', '".$data['created_dttm']."')";
				$query = $this->db->query($sql);
				if ($query) {
					echo "successall";
				} else {
					echo "failedsaveuserdetail";
				}
			} else {
				echo "failedsaveusermaster";
			}
		}

		public function checkUsername($username) {
			$sql = "select a.user_id, a.username, a.password, b.user_fullname, c.unit_name, d.department_name 
					from t_master_user as a 
					left join t_detail_user as b on a.user_id = b.user_id 
					left join t_m_unit as c on b.user_unit = c.unit_id 
					left join t_m_department as d on b.user_department = d.department_id 
					where a.username = '".$username."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$user_id  = $rows->user_id;
				$username  = $rows->username;
				$password  = $rows->password;
				$user_fullname  = $rows->user_fullname;
				$unit_name  = $rows->unit_name;
				$department_name  = $rows->department_name;

				if (($username == "" && $password == "") || (!$username && !$password)) {
					return false;
				} else {
					return array(
						"user_id" => $user_id,
						"username" => $username,
						"password" => $password,
						"user_fullname" => $user_fullname,
						"unit_name" => $unit_name, 
						"department_name" => $department_name
					);
				}

			} else {
				return false;
			}
		}
	}
?>
