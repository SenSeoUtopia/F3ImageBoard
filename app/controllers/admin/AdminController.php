<?php

class AdminController extends Controller {

    protected $tpl = "layouts/admincp.htm";

    /**
     * Show Dashboard
     * @param Base $f3
     * @return mixed
     */
    function dashboard(Base $f3){
        $title = 'Dashboard';
        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }


    /**
     * Board List
     * @param Base $f3
     * @return mixed
     */
    function boards(Base $f3){

        $title = 'Manage Boards';

        $boards = Boards::all();

       return $f3->set('page', array('title'=> $title,'content' => 'admin/boards.htm','boards_list' => $boards));

    }

    /**
     * Boards Create
     * @param Base $f3
     * @return mixed
     */

    public function boards_create(Base $f3){
        $title = 'Create Boards';

        $category_list = Category::all();

        return $f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list));
    }

    public function boards_create_save(Base $f3){
        $title = 'Create Boards';

        $upload_dir = $this->upload_dir;

        $data = $f3->get('POST');
        $valid = Validate::is_valid($data, array(
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required'
        ));

        $board_slug = $data['slug'];

        $category_list = Category::all();

        if($valid === true) {

            $check = Boards::where("slug",$data['slug'])->exists();

            if($check){
                $error = array("error" => true,"msg" => "Board Already Exists");
                return $f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list,'errors' => $error));
            }

            $boards = Boards::firstOrNew(["name" => $data['name'],"slug" => $data['slug']]);
            //	$boards->category_id = $data['category_id'];
            if($boards->save()) {
                $msg = array("success" => true,"msg" => "Board Created.");
            } else {
                $msg = array("error" => true,"msg" => "Unable to Create Board");
            }

            if(!file_exists("$upload_dir/$board_slug")){
                mkdir("$upload_dir/$board_slug");
            }

            $f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list,'success' => $msg));
        } else {
            $f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list,'errors' => $valid));
        }

    }

    /* Boards Edit */
    public function boards_edit(Base $f3,$args){

        $board_id = $args['board_id'];

        $board = Boards::find($board_id);

        $category_list = Category::all();

        $board_title = $board->name;
        $board_slug = $board->slug;

        $title = "Editing Board <q>/$board_slug/ - $board_title</q>";

        return $f3->set('page', array('title'=> $title,'content' => 'admin/boards_edit.htm','board' => $board,'category_list' => $category_list));
    }

    public function boards_edit_save(Base $f3,$args){

        $msg = array();

        $success = false;

        $board_id = $args['board_id'];

        $data = $f3->get('POST');

        $board = Boards::find($board_id);

        $board->name = $data['name'];
        $board->slug = $data['slug'];
        $board->category_id = $data['category_id'];
        $board->show_contry_flag = isset($data['show_contry_flag']) ? $data['show_contry_flag']: 0;
        if($board->save()) {
            $msg[] = "Board has been Updated successfully.";
            $success = true;
        } else {
            $msg[] = "Unable to Update Board";
        }

        $board_title = $board->name;
        $board_slug = $board->slug;

        $title = "Editing Board /$board_slug/ - $board_title";

        $category_list = Category::all();

        return $f3->set('page', array(
            'title'=> $title,
            'content' => 'admin/boards_edit.htm',
            'board' => $board,
            'category_list' => $category_list,
            'success' => $success,
            "msg" => $msg
        ));
    }

    /* Boards Delete */
    public function boards_delete(Base $f3){
        $title = 'Board Delete';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Threads List */
    public function threads(Base $f3){
        $title = 'Threads List';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Threads Create */
    public function threads_create(Base $f3){
        $title = 'Thread Create';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function threads_create_save(Base $f3){
        $title = 'Thread Create';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Threads Edit */
    public function threads_edit_save(Base $f3,$args){
        $title = 'Editing Thread';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Threads Delete */
    public function threads_delete(Base $f3){
        $title = 'Editing Thread';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Posts List */
    public function posts(Base $f3){
        $title = 'Posts Lists';

        $posts = Posts::whereNotNull("content")->paginate(20);

        return $f3->set('page', array('title'=> $title,'content' => 'admin/post_list.htm','posts_list' => $posts));
    }

    /* Posts Create */
    public function posts_create(Base $f3){
        $title = 'Post Create';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function posts_create_save(Base $f3){
        $title = 'Post Create';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Posts Edit */
    public function posts_edit(Base $f3,$args){
        $title = 'Post Editing';

        $post_id = $args["post_id"];

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function posts_edit_save(Base $f3){
        $title = 'Post Editing';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Posts Delete */
    public function posts_delete(Base $f3){
        $title = 'Post Removed';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Photos List */
    public function photos(Base $f3){
        $title = 'Photos';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/photos.htm'));
    }

    /* Photos Delete */
    public function photos_delete(Base $f3){
        $title = 'Photos Removed';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Reports List */
    public function reports(Base $f3){
        $title = 'Reports';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Reports Create */
    public function reports_create(Base $f3){
        $title = 'Report Create';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Reports Edit */
    public function reports_edit(Base $f3){
        $title = 'Report Editing';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function reports_edit_save(Base $f3){
        $title = 'Report Editing';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Reports Delete */
    public function reports_delete(Base $f3){
        $title = 'Report Removed';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Bans List */
    public function bans(Base $f3){
        $title = 'Bans List';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/bans.htm'));
    }

    /* Bans Create */
    public function bans_create(Base $f3){
        $title = 'Ban a User';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/bans_create.htm'));
    }

    public function bans_create_save(Base $f3){
        $title = 'Ban a User';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Bans Edit */
    public function bans_edit(Base $f3){
        $title = 'Viewing Ban';

        $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function bans_edit_save(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Bans Delete */
    public function bans_delete(Base $f3){
        $title = 'Ban Removed';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    /* Settings */
    public function settings(Base $f3){
        $title = 'Settings';

        $settings = Settings::pluck("value","title");

        return $f3->set('page', array('title'=> $title,'content' => 'admin/settings.htm','settings' => $settings));
    }

    /* Settings Save */
    public function settings_save(Base $f3){
        $title = 'Settings';

        $msg = null;

        $f3->set('page', array('title'=> $title,'content' => 'admin/settings.htm','msg' => $msg));
    }

    public function announcements(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function news(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function bbcodes(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function embeds(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function ads(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function wordfilter(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function spamfilter(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function global_message(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }

    public function users(Base $f3){
        $title = 'Viewing Ban';

        return $f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
    }
}