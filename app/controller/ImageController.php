<?php
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller{

// Thumb View
public function thumb($f3,$args){

$valid = Validate::is_valid($args, array(
'board_slug' => 'required',
'thread_id' => 'required',
'file_name' => 'required'
));

if($valid === true) {
$public_dir = $this->public_dir;
$upload_dir = $this->upload_dir;

$allowed = array('jpg','jpeg','png');

$file_name = isset($args['file_name']) ?  filter_var($args['file_name'], FILTER_SANITIZE_STRING) : null;

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if(!in_array($ext,$allowed)){
return $f3->read("$public_dir/img/no-thumb.png");
}

$board_slug = $args['board_slug'];
$thread_id = $args['thread_id'];

$img_path = "$upload_dir/$board_slug/$thread_id/$file_name";

if(file_exists($img_path)){

Image::configure(array('driver' => 'imagick'));
$img = Image::make($img_path);

$img->resize(150, null, function ($constraint) {
$constraint->aspectRatio();
});

echo $img->response("jpg");
} else {
$img = Image::make("$public_dir/img/no-thumb.png");
echo $img->response("png", 70);
}


} else {
$img = Image::make("$public_dir/img/no-thumb.png");
echo $img->response("png", 70);
}

}

}