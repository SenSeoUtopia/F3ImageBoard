<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Threads extends Eloquent{

protected $table = "threads";

// Relationship Post
public function posts(){
return $this->hasMany("Posts","thread_id");
}

// Relationship Post
public function boards(){
return $this->belongsTo("Boards");
}

// Relationship Post
public function photos(){
return $this->hasMany("Photos","thread_id");
}

}