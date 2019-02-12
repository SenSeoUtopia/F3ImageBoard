<?php

class BanController extends AdminController
{

    /**
     * Bans List
     * @param Base $f3
     * @return mixed
     */
    public function bans(Base $f3)
    {
        $title = 'Bans List';

        return $f3->set('page', array('title' => $title, 'content' => 'admin/bans.htm'));
    }

    /**
     * Bans Create
     * @param Base $f3
     * @return mixed
     */
    public function bans_create(Base $f3)
    {
        $title = 'Ban a User';

        $f3->set('page', array('title' => $title, 'content' => 'admin/bans_create.htm'));
    }

    public function bans_create_save(Base $f3)
    {
        $title = 'Ban a User';

        $f3->set('page', array('title' => $title, 'content' => 'admin/dashboard.htm'));
    }

    /**
     * Bans edit
     * @param Base $f3
     * @return mixed
     */
    public function bans_edit(Base $f3)
    {
        $title = 'Viewing Ban';

        $f3->set('page', array('title' => $title, 'content' => 'admin/dashboard.htm'));
    }

    public function bans_edit_save(Base $f3)
    {
        $title = 'Viewing Ban';

        $f3->set('page', array('title' => $title, 'content' => 'admin/dashboard.htm'));
    }

    /*
     * Bans Delete
     * @param Base $f3
     * @return mixed
     */
    public function bans_delete(Base $f3)
    {
        $title = 'Ban Remove';

        $f3->set('page', array('title' => $title, 'content' => 'admin/dashboard.htm'));
    }

}