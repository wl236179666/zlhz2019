<?php
namespace app\api\controller;

use think\Controller;

class Base extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}
