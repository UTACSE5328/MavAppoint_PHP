<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/27
 * Time: 14:10
 */

namespace Test;

use Models\Bean\AppointmentType;
use Models\Db\DatabaseManager;
use Models\bean\Appointment;
use Models\Login\AdvisorUser;
use Models\Login\StudentUser;

class DatabaseManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGetStudentEmails()
    {
        $dbManager = new DatabaseManager();
        $res = $dbManager->getStudentEmails();
        self::assertContainsOnly('string', $res);
    }

    public function testGetCSEUser()
    {
        $dbManager = new DatabaseManager();
        $res = $dbManager->getCSEUser("");
        self::assertEquals(null, $res);
        $res = $dbManager->getCSEUser("doesnotexist");
        self::assertEquals(null, $res);
        $res = $dbManager->getCSEUser("User1");
        self::assertInstanceOf(AdvisorUser::class, $res);
    }

    public function testGetCSEStudent()
    {
        $dbManager = new DatabaseManager();
        $res = $dbManager->getCSEStudent("");
        self::assertEquals(null, $res);
        $res = $dbManager->getCSEStudent("1111111111");
        self::assertEquals(null, $res);
        $res = $dbManager->getCSEStudent("1001455617");
        self::assertInstanceOf(StudentUser::class, $res);
    }

    public function testSetCutOffTime()
    {
        $dbManager = new DatabaseManager();
        $res = $dbManager->setCutOffTime(100, rand(0, 100));
        self::assertEquals(true, $res);
        $res = $dbManager->setCutOffTime(100, -1);
        self::assertEquals(false, $res);
        $res = $dbManager->setCutOffTime(000, 1);
        self::assertEquals(false, $res);
    }

    public function testAddAppointmentType()
    {
        $at = new AppointmentType();
        $dbManager = new DatabaseManager();

        $at->setType("Test");
        $at->setDuration("100");
        $res = $dbManager->addAppointmentType(103, $at);
        self::assertEquals(true, $res);
        $res = $dbManager->addAppointmentType(103, $at);
        self::assertEquals(false, $res);

        $at->setType("Test2");
        $at->setDuration("-1");
        $res = $dbManager->addAppointmentType(103, $at);
        self::assertEquals(false, $res);
    }

    public function testDeleteAppointmentType(){
        $at = new AppointmentType();
        $dbManager = new DatabaseManager();

        $at->setType("Test");
        $at->setDuration("100");
        $res = $dbManager->deleteAppointmentType(103, $at);
        self::assertEquals(true, $res);
        $res = $dbManager->deleteAppointmentType(103, $at);
        self::assertEquals(false, $res);
        $res = $dbManager->deleteAppointmentType(100, $at);
        self::assertEquals(false, $res);
    }

    public function testGetAppointmentTypes(){
        $dbManager = new DatabaseManager();
        $res = $dbManager->getAppointmentTypes("Zhenyu Chen");
        self::assertContainsOnly(AppointmentType::class, $res);
    }

    public function testCreateAppointment()
    {
        $apt = new Appointment();
        $dbManager = new DatabaseManager();

        $apt->setAdvisingDate("2017-03-01");
        $apt->setAdvisingStartTime("17:00:00");
        $apt->setAdvisingEndTime("17:05:00");
        $apt->setStudentId("1001331545");
        $apt->setPname("Lin Gao");
        $apt->setAppointmentId("444");
        $apt->setAppointmentType("Swap Course");
        $apt->setDescription("Description");
        $apt->setStudentPhoneNumber("1111111111");

        $res = $dbManager->createAppointment($apt, "zhangjwuta@gmail.com");
        self::assertEquals(true, $res['response']);
    }

    public function testCancelAppointment(){

    }

    public function testAddTimeSlot()
    {

    }

    public function testDeleteTimeSlot()
    {

    }

    /*
    public function createAppointmentTest(){
        $dbManager = new DatabaseManager();
        $apt = new Appointment();
        $apt->setPname("Lin Gao");
        $apt->setAppointmentId("355");
        $apt->setAdvisingDate("2017-02-22");
        $apt->setAdvisingStartTime("13:05:00");
        $apt->setAdvisingEndTime("13:10:00");
        $apt->setAppointmentType("Swap Course");
        $apt->setDescription("description");
        $apt->setStudentPhoneNumber("1111111111");

        $res = $dbManager->createAppointment($apt, "shaoying.li@mavs.uta.edu");
        //self::assertEquals($res, true);
        //self::assertAttributeContains()
    }*/

}
