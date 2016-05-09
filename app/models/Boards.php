<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Boards extends Eloquent {

protected $table = "boards";

// Relationship Post
public function posts(){
return $this->hasMany("Posts");
}

// Relationship Photos
public function threads(){
return $this->hasMany("Threads","board_id");
}

public function category(){
return $this->belongsTo("Category");
}

}