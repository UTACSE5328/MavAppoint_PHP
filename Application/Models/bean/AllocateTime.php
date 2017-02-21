<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 2:10
 */

class AllocateTime{
    private $data;
    private $startTime;
    private $endTime;
    private $email;
    private $reasons;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getReasons()
    {
        return $this->reasons;
    }

    /**
     * @param mixed $reasons
     */
    public function setReasons($reasons)
    {
        $this->reasons = $reasons;
    }


}