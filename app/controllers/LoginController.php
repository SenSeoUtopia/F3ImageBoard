<?php

class LoginController extends Controller
{

    protected $tpl = "layouts/login.htm";

    public function login(Base $f3){

        $title = "Sign In";
        return $f3->set("page",array("content" => "admin/login.htm","title" => $title));
    }

}