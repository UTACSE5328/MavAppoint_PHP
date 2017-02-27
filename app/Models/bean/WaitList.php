<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 2:24
 */
namespace Models\Bean;

class WaitList{
    private $waitListId;
    private $studentId;
    private $studentEmail;
    private $studentPhone;
    private $advisorName;
    private $date;

    /**
     * @return mixed
     */
    public function getWaitListId()
    {
        return $this->waitListId;
    }

    /**
     * @param mixed $waitListId
     */
    public function setWaitListId($waitListId)
    {
        $this->waitListId = $waitListId;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getStudentEmail()
    {
        return $this->studentEmail;
    }

    /**
     * @param mixed $studentEmail
     */
    public function setStudentEmail($studentEmail)
    {
        $this->studentEmail = $studentEmail;
    }

    /**
     * @return mixed
     */
    public function getStudentPhone()
    {
        return $this->studentPhone;
    }

    /**
     * @param mixed $studentPhone
     */
    public function setStudentPhone($studentPhone)
    {
        $this->studentPhone = $studentPhone;
    }

    /**
     * @return mixed
     */
    public function getAdvisorName()
    {
        return $this->advisorName;
    }

    /**
     * @param mixed $advisorName
     */
    public function setAdvisorName($advisorName)
    {
        $this->advisorName = $advisorName;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}