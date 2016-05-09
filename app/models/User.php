<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

protected $table = "users";

// Relationship Post
public function post(){
return $this->hasMany("Post");
}

// Relationship Photos
public function threads(){
return $this->hasMany("Photo");
}


}