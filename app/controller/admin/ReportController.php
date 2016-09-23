<?php

class ReportController extends AdminController {

/* Reports List */
public function reports($f3){
$title = 'AdminCP : Reports';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Create */
public function reports_create($f3){
$title = 'AdminCP : Report Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Edit */
public function reports_edit($f3){
$title = 'AdminCP : Report Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function reports_edit_save($f3){
$title = 'AdminCP : Report Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Delete */
public function reports_delete($f3){
$title = 'AdminCP : Report Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}


}