<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Photos extends Eloquent{

protected $table = "photos";

protected $fillable = ['original_name','board_id','thread_id','post_id'];

// Relationship Post
public function post(){
return $this->belongsTo("Posts");
}

// Relationship Boards
public function boards(){
return $this->belongsTo("Boards","board_id");
}

// Relationship Thread
public function threads(){
return $this->belongsTo("Threads","thread_id");
}

/* Get Photos */
public function get_photos($post_id){
return $this->where('post_id',$post_id)->get();
}

/* Get All Photos of Thread */
public function get_photos_all($thread_id,$post_id){
return $this->where(array('post_id' => $post_id, 'thread_id' => $thread_id))->get();
}

/* Total Images */
public static function total_images($thread_id){
return Photos::where('thread_id', $thread_id)->count();
}

public function photo_delete($board_slug,$thread_id,$img_id){

if(count($img_id) > 1){
foreach($img_id as $photo_id){
$photo = $this->find('id=?',$photo_id);
$photo_name = $photo->file_name;

$path = public_path("uploads/$board_slug/$thread_id/$photo_name");

if(File::exists($path)){

File::delete($path);

$msg = "File Deleted Successfully";
} else {
$msg = "File Can't be Deleted.";
}
}
} else{
$photo = $this->find('id=?',$img_id);
$photo_name = $photo->file_name;

$path = public_path("uploads/$board_slug/$thread_id/$photo_name");

if(File::exists($path)){

File::delete($path);

$msg = "File Deleted Successfully";
} else {
$msg = "File Can't be Deleted.";
}
}

return $msg;
}


    
}