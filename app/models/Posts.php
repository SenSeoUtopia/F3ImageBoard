<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Posts extends Eloquent{

protected $table = "posts";

protected $fillable = ['content','ip','user_name','thread_id','board_id'];

// Boards
public function boards(){
return $this->belongsTo("Boards");
}

// Relationship Photos
public function threads(){
return $this->belongsTo("Threads", "thread_id");
}

// Relationship Post
public function photos(){
return $this->hasMany("Photos","post_id");
}

public function get_post($post_id){

return $this->find($post_id);
}

public function get_post_from_thread($board_id,$thread_id){
return $this->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->get();
}


public function thread_is_post($post_id){
return $this->where(array('id' => $board_id,'is_thread' => 1))->count();
}

public function total_posts($board_id,$thread_id){
return $this->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->count();
}

public function total_posters($board_id,$thread_id){
return $this->distinct()->where(array('board_id' => $board_id, 'thread_id' => $thread_id))->count('ip');
}



    
}