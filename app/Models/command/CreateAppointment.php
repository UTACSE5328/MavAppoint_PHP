<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 9:29
 */
namespace Models\Command;
use Models\Bean\Appointment;
class CreateAppointment extends SQLCmd {
	private $apt, $email;


	function __construct(Appointment $apt, $email) {
		$this->apt   = $apt;
		$this->email = $email;
	}

	function queryDB() {
		$query = "SELECT userid from user where email='$this->email'";
		$res   = $this->conn->query($query)->fetch_assoc();
		$id    = $res['userid'];

		$query  = "SELECT notification from user_student where userId='$id'";
		$res    = $this->conn->query($query)->fetch_assoc();
		$notify = $res['notification'];

		$pName     = $this->apt->getPname();
		$query     = "SELECT userid FROM User_Advisor WHERE User_Advisor.pname='$pName'";
		$res       = $this->conn->query($query)->fetch_assoc();
		$advisorId = $res['userid'];

		$query          = "SELECT notification from user_advisor where userId='$advisorId'";
		$res            = $this->conn->query($query)->fetch_assoc();
		$notify_advisor = $res['notification'];

		$query        = "SELECT email from user where userId='$advisorId'";
		$res          = $this->conn->query($query)->fetch_assoc();
		$advisorEmail = $res['email'];

		$aptId       = $this->apt->getAppointmentId();
		$date        = $this->apt->getAdvisingDate();
		$start       = $this->apt->getAdvisingStartTime();
		$end         = $this->apt->getAdvisingEndTime();
		$type        = $this->apt->getAppointmentType();
		$description = $this->apt->getDescription();
		$phone       = $this->apt->getStudentPhoneNumber();

		$query = "SELECT COUNT(*) FROM Advising_Schedule
                    WHERE userid='$aptId' AND date='$date' AND start='$start' AND end='$end' AND studentId is not null";
		if ($this->conn->query($query)->fetch_assoc() > 0) {
			$query = "INSERT INTO Appointments
                      (id,advisor_userid,student_userid,date,start,end,type,studentId,description,student_email,student_cell)
                      VALUES('$aptId','$advisorId','$id','$date','$start','$end','$type','$id','$description','$this->email','$phone')";
			$this->conn->query($query);

			$query = "UPDATE Advising_Schedule SET
                      studentId='$id' where userid='$advisorId' AND date='$date' and start >= '$start' and end <= '$end'";

			if ($this->conn->query($query) == true) {
				$success = true;
			} else {
				$success = false;
			}

		} else {
			$success = false;
		}

		$this->result = array(
			"student_notify" => $notify,
			"advisor_notify" => $notify_advisor,
			"advisor_email"  => $advisorEmail,
			"response"       => $success,
		);
	}

	function processResult() {
		return $this->result;
	}
}