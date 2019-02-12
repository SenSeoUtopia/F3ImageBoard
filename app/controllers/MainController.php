<?php

class MainController extends Controller
{

    public function style(Base $f3)
    {

        $style = $f3->exists('POST.style') ? $f3->get('POST.style') : 'style';

        $get_style = array("style", "Yotsuba", "YotsubaBlue", "Futaba", "Burichan", "Tomorrow", "Photon");

        if (in_array($style, $get_style)) {
            $expire = strtotime("+1 day");

            $f3->set("COOKIE.style", $style, $expire);

            return Response::json(array('success' => true, 'msg' => 'Style Applied'));
        } else {
            return Response::json(array('success' => false, 'msg' => 'Invalid Style Name'));
        }

    }

    function render(Base $f3, $args)
    {

        $title = "Home";

        $board_list = Category::all();

        $post_list = Posts::whereNotNull("content")->orderBy('created_at', 'desc')->take('10')->get();
        $photo_list = Photos::where("photo_type", "image")->orderBy('created_at', 'desc')->take('10')->get();

        $upload_dir = dirsize($this->upload_dir);

        $total_size = formatSizeUnits($upload_dir);

        $f3->set("category_list", $board_list);
        $f3->set("post_list", $post_list);
        $f3->set("photo_list", $photo_list);

        $f3->set('page', array('title' => $title, 'content' => 'home.htm', 'board_list' => $board_list, 'total_size' => $total_size));
    }

    /* Board View */
    function board_view(Base $f3, $args)
    {

        $board_slug = $args['board_slug'];

        $site_key = $f3->get("recaptcha_key");

        $board_list = Boards::where('slug', $board_slug)->firstorFail();

        $board_title = $board_list->name;
        $board_id = $board_list->id;
        $board_slug = $board_list->slug;

        $title = "/$board_slug/ - $board_title";

        $board_header_title = "/$board_slug/ - $board_title";

        $limit = 5;
        $page = $f3->exists("GET.page") ? $f3->get("GET.page") : 1;

        $threads = Threads::where('board_id', $board_id)->paginate($limit, ['*'], 'page', $page);

        $total_results = $threads->total();

        // build page links
        $pages = new Pagination($total_results, $limit);

        $pages->setCurrent($page);

        $pages->setRouteKeyPrefix('?page=');

        // add some configuration if needed
        $pages->setTemplate('widgets/pagination.htm');
        // for template usage, serve generated pagebrowser to the hive
        $f3->set('pagebrowser', $pages->serve());

        $f3->set('page', array(
            'title' => $title,
            'content' => "threads.htm",
            'site_key' => $site_key,
            'board_slug' => $board_slug,
            'board_title' => $board_header_title,
            'post_list' => $threads
        ));

    }

    /* Board View */
    function catalog(Base $f3, $args)
    {

        $board_slug = $args['board_slug'];

        $site_key = $f3->get("recaptcha_key");

        $board_list = Boards::where('slug', $board_slug)->first();

        $board_title = $board_list->name;
        $board_slug = $board_list->slug;

        $title = "/$board_slug/ - $board_title";

        $board_header_title = "/$board_slug/ - $board_title";

        $f3->set('page', array(
            'title' => $title,
            'site_key' => $site_key,
            'board_slug' => $board_slug,
            'board_title' => $board_header_title,
            'content' => 'catalog.htm',
            'board_list' => $board_list
        ));
    }

    /* Thread View*/
    public function thread_view(Base $f3, $args)
    {

        $site_key = $f3->get("recaptcha_key");

        $board_slug = $args['board_slug'];

        $boards = Boards::where('slug', $board_slug)->first();

        $board_title = $boards->name;

        $board_slug = $boards->slug;

        $board_id = $boards->id;

        $threads = Threads::find($args['thread_id']);

        $thread_id = $threads->id;
        $thread_title = $threads->name;

        $title = "/$board_slug/ - $board_title - Thread #$thread_id $thread_title";

        $post_list = Posts::where(array('board_id' => $board_id, 'thread_id' => $thread_id))->get();

        $total_poster = $post_list->where('is_thread',0)->groupBy("ip")->count();

        $total_images = Photos::total_images($thread_id);

        $total_reply = $post_list->where('is_thread',0)->count();

        $board_header_title = "/$board_slug/ - $board_title";

        $f3->set('page',
            array(
                'content' => "posts.htm",
                'title' => $title,
                'site_key' => $site_key,
                'board_slug' => $board_slug,
                'board_title' => $board_header_title,
                'thread_id' => $thread_id,
                'post_list' => $post_list,
                'total_posters' => $total_poster,
                'total_images' => $total_images,
                'total_posts' => $total_reply
            )
        );
    }

}