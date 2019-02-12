<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Photos extends Eloquent{

    /**
     * Table Name
     * @var string
     */
	protected $table = "photos";

    /** Mass Assignment
     * @var array
     */
	protected $fillable = ['original_name','board_id','thread_id','post_id'];

    /**
     * Relationship Posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function post(){
		return $this->belongsTo("Posts");
	}

    /**
     * Relationship Boards
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function boards(){
		return $this->belongsTo("Boards","board_id");
	}

    /**
     * Relationship of Thread
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function threads(){
		return $this->belongsTo("Threads","thread_id");
	}

    /**
     * Check Duplicates Files
     * @param $file_hash
     * @return boolean
     */
    public static function check_duplicate($file_hash){
        return self::where("file_hash",$file_hash)->exists();
    }


    /**
     * Get Photos
     * @param $post_id
     * @return mixed
     */
	public function get_photos($post_id){
		return $this->where('post_id',$post_id)->get();
	}

    /**
     * Get All Photos of Thread
     * @param $thread_id
     * @param $post_id
     * @return mixed
     */
	public function get_photos_all($thread_id,$post_id){
		return $this->where(array('post_id' => $post_id, 'thread_id' => $thread_id))->get();
	}

    /**
     * Total Images of a Thread
     * @param $thread_id
     * @return mixed
     */
    public static function total_images($thread_id){
        return self::where('thread_id', $thread_id)->whereNull('op_img')->count();
    }

}