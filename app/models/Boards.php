<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Boards extends Eloquent {

protected $table = "boards";

protected $fillable = ['name','slug','category_id'];

// Relationship Post
public function posts(){
return $this->hasMany("Posts","board_id");
}

// Relationship Photos
public function photos(){
return $this->hasMany("Photos","board_id");
}

// Relationship Threads
public function threads(){
return $this->hasMany("Threads","board_id");
}

// Relationship Category
public function category(){
return $this->belongsTo("Category");
}

}