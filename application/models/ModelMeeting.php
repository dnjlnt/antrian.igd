<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class ModelMeeting extends CI_Model {
        public function getMeetingID() {
			$sql = "SELECT max(meeting_id) as maxID FROM t_master_meeting";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows	= $query->row();
				$maxID  = $rows->maxID;

				if ($maxID == "") {
					$getNumberID = "000";
				} else {
					$getNumberID = (int) substr($maxID, 8, 3);
					$getNumberID = $getNumberID + 1;
				}
				$code = "MEETING_";
				$getMeetingID = $code . sprintf("%03s", $getNumberID);

				return $getMeetingID;
			} else {
				return false;
			}
		}

		public function getAllMeetingRoom() {
			$sql = "select * from t_m_meeting_room where meeting_room_status = '0'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}

        public function checkingTime($meeting_room, $meeting_date) {
			$sql = "select max(meeting_to_time) as last_meeting_time 
                    from t_master_meeting 
                    where meeting_date = '".$meeting_date."' and meeting_room_id = '".$meeting_room."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows = $query->row();
				$last_meeting_time = $rows->last_meeting_time;

                return $last_meeting_time;
			} else {
				return false;
			}
		}

        public function saveNewMeeting($meeting_id, $meeting_title, $meeting_date, $meeting_from_time, $meeting_to_time, $meeting_room, $meeting_qrcode, $created_by, $created_dttm) {
            $sql = "insert into t_master_meeting (meeting_id, meeting_title, meeting_date, meeting_from_time, meeting_to_time, meeting_room_id, meeting_qrcode, created_by, 
					created_dttm) value ('".$meeting_id."', '".$meeting_title."', '".$meeting_date."', '".$meeting_from_time."', '".$meeting_to_time."', '".$meeting_room."', 
					'".$meeting_qrcode."', '".$created_by."', '".$created_dttm."')";
            $query = $this->db->query($sql);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function getListMeeting($user_id) {
            $sql = "select a.meeting_id, a.meeting_title, a.meeting_date, a.meeting_from_time, a.meeting_to_time, b.meeting_room_name 
                    from t_master_meeting as a 
                    left join t_m_meeting_room as b on a.meeting_room_id = b.meeting_room_id 
                    where a.created_by = '".$user_id."'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
        }

        public function getQrCode($meeting_id) {
			$sql = "select meeting_qrcode from t_master_meeting where meeting_id = '".$meeting_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$rows = $query->row();
				$meeting_qrcode = $rows->meeting_qrcode;

                return $meeting_qrcode;
			} else {
				return false;
			}
		}

        public function getListMeetingAttendee($user_id) {
            $sql = "select a.meeting_id, a.meeting_title, a.meeting_date, a.meeting_from_time, a.meeting_to_time, a.meeting_qrcode, b.meeting_room_name 
                    from t_master_meeting as a 
                    left join t_m_meeting_room as b on a.meeting_room_id = b.meeting_room_id 
                    where a.created_by = '".$user_id."'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

		public function getAllMeetingToday() {
			$sql = "select a.meeting_room_id, b.meeting_room_name, count(a.meeting_room_id) as totalmeeting 
					from t_master_meeting as a
					left join t_m_meeting_room as b on a.meeting_room_id = b.meeting_room_id 
					where a.meeting_date = '2022-07-21'
					group by a.meeting_room_id";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}

		public function getMeetingByRoom($meeting_room_id) {
			$sql = "select meeting_title, meeting_from_time, meeting_to_time 
					from t_master_meeting 
					where meeting_date = '2022-07-21' and meeting_room_id = '".$meeting_room_id."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}
	}
?>
