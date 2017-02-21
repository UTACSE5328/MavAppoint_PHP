<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 15:15
 */
class UpdateAppointment extends SQLCmd {
	private $apt;

	function __construct(Appointment $apt) {
		$this->apt = $apt;
	}

	function queryDB() {
		$description = $this->apt->getDescription();
		$studentId   = $this->apt->getStudentId();
		$id          = $this->apt->getAppointmentId();

		$query = "UPDATE appointments SET description='$description',studentId='$studentId' where id='$id'";
		$this->conn->query($query);

		if (mysqli_affected_rows($this->conn) == 0) {
			$this->result = false;
		} else {
			$this->result = true;
		}
	}

	function processResult() {
		return $this->result;
	}
}