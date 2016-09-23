<?php

class BanController extends AdminController {

/* Bans List */
public function bans($f3){
$title = 'AdminCP : Bans List';

$f3->set('page', array('title'=> $title,'content' => 'admin/bans.htm'));
}

/* Bans Create */
public function bans_create($f3){
$title = 'AdminCP : Ban a User';

$f3->set('page', array('title'=> $title,'content' => 'admin/bans_create.htm'));
}

public function bans_create_save($f3){
$title = 'AdminCP : Ban a User';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans Edit */
public function bans_edit($f3){
$title = 'AdminCP : Viewing Ban';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function bans_edit_save($f3){
$title = 'AdminCP : Viewing Ban';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans Delete */
public function bans_delete($f3){
$title = 'AdminCP : Ban Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

}