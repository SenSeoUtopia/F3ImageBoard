<?php

class AdminController extends Controller{

function dashboard($f3){

$title = 'AdminCP';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));

}


}