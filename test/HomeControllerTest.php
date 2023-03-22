<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';
class HomeControllerTest extends TestCase
{

    public function testDefaultAction()
    {
        $controller = new HomeController();
        $view = $controller->defaultAction();
        $this->assertEquals($view, View::show('home/home'));
    }










}
