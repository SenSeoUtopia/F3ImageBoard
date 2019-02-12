<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Posts extends Eloquent{

	protected $table = "posts";

	protected $fillable = ['content','ip','user_name','thread_id','board_id'];

	// Boards

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function boards(){
		return $this->belongsTo("Boards","board_id");
	}

	// Relationship Photos

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function threads(){
		return $this->belongsTo("Threads", "thread_id");
	}

	// Relationship Post

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
		return $this->hasMany("Photos","post_id");
	}

    /**
     * @param $post_id
     * @return mixed
     */
    public function get_post($post_id){

		return $this->find($post_id);
	}

    /**
     * @param $board_id
     * @param $thread_id
     * @return mixed
     */
    public function get_post_from_thread($board_id, $thread_id){
		return $this->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->get();
	}


    /**
     * @param $post_id
     * @return mixed
     */
    public function thread_is_post($post_id){
		return $this->where(array('id' => $post_id,'is_thread' => 1))->count();
	}

    /**
     * @param $board_id
     * @param $thread_id
     * @return mixed
     */
    public function total_posts($board_id, $thread_id){
		return $this->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->count();
	}

    /**
     * @param $board_id
     * @param $thread_id
     * @return mixed
     */
    public function total_posters($board_id, $thread_id){
		return $this->distinct()->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->count('ip');
	}

	public static function check_duplicate($board_id,$thread_id,$ip,$content){
        return self::where(['board_id' => $board_id, 'thread_id' => $thread_id, 'content' => htmlspecialchars($content),'ip' => $ip])->exists();
    }

	
}