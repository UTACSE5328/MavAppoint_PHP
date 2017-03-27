<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/27
 * Time: 14:10
 */

namespace Test;


use Models\Db\DatabaseManager;


class DatabaseManagerTest extends \PHPUnit_Framework_TestCase
{
    public function test1(){
        $dbManager = new DatabaseManager();
        /** @var AdvisorUser[] $res */
        $res = $dbManager->getAdvisorsOfDepartment("CSE");
        var_dump($res);
    }
}
