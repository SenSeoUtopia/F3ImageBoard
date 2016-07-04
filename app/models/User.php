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

// Check is Admin
public static function check_is_admin($user_id){
return User::where(array('id' => $user_id,'is_admin' => 1))->count();
}

}