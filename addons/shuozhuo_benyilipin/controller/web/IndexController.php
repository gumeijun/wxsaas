<?php
namespace app\shuozhuo_benyilipin\controller\web;
use wxsaas\controller\AddonsBaseController;
use wxsaas\model\Users;
class IndexController extends AddonsBaseController
{
    public function index()
    {
        return $this->fetch();
    }
}
