<?php
	if ($this->uri->segment(1) == "dashboard") {
		$bc = "Dashboard";
	} else if ($this->uri->segment(1) == "meetingroom") {
		if ($this->uri->segment(2) == "request") {
			$bc = "Meeting Room - <small>Your Request (s)</small>";
		} else if ($this->uri->segment(2) == "approved") {
			$bc = "Meeting Room - <small>Approved</small>";
		} else if ($this->uri->segment(2) == "add") {
			$bc = "Meeting Room - <small>Add Request</small>";
		}
	} else if ($this->uri->segment(1) == "formrequest") {
		$bc = "Form Request - <small>Your Request (s)</small>";

		if ($this->uri->segment(2) == "add") {
			$bc = "Form Request - <small>Add Form Request</small>";
		}
	} else {
		$bc = "";
	}
?>

<!-- <div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h6 class="m-0"><?php echo $bc; ?></h6>
			</div>
		</div>
	</div>
</div> -->