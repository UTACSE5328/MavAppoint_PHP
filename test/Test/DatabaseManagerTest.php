<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/27
 * Time: 14:10
 */

namespace Test;
use Models\Db\DatabaseManager;
use Models\bean\Appointment;

class DatabaseManagerTest extends \PHPUnit_Framework_TestCase
{
    public function test1(){
        $dbManager = new DatabaseManager();
        /** @var AdvisorUser[] $res */
        $res = $dbManager->getAdvisorsOfDepartment("ARCH");
        var_dump($res);
    }

    public function test2(){
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

        var_dump($res);
        self::assertEquals($res, true);
    }

}
