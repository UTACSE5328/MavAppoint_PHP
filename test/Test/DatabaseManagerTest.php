<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/26
 * Time: 13:10
 */

namespace Test;


use Models\Db\DatabaseManager;
use Models\Login\AdvisorUser;


class DatabaseManagerTest extends \PHPUnit_Framework_TestCase
{
    public function test1(){
        $dbManager = new DatabaseManager();
        /** @var AdvisorUser[] $res */
        $res = $dbManager->getAdvisorsOfDepartment("CSE");

//        foreach ($res as $advisorUser){
            $this->assertEquals($res[0]->getPName(), "abcd");
//        }

    }
//    $res = $manager->getAdvisorsOfDepartment("CSE");
}
