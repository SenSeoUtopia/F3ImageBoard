<?php

class AjaxController extends Controller{
	
protected $tpl = null;

/* Set Users Settings */
public function set_settings($f3,$args){

$settings = $f3->get("GET");

// Thread Watcher
$thread_watcher = isset($settings['thread_watcher']) ? true : false;
// Auto Loader
$thread_watcher = isset($settings['thread_watcher']) ? true : false;
// Updated Sound
$thread_watcher = isset($settings['updater_sound']) ? true : false;
// Quick Reply
$thread_watcher = isset($settings['quick_reply']) ? true : false;
// Show Spoiler Images
$thread_watcher = isset($settings['thread_watcher']) ? true : false;
// Show Quote by
$thread_watcher = isset($settings['thread_watcher']) ? true : false;
// Show Thread Stats
$thread_watcher = isset($settings['thread_watcher']) ? true : false;
//
$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;

$thread_watcher = isset($settings['thread_watcher']) ? true : false;


return Response::json($settings);
}


/* Get Selected Post Data */
public function get_post($f3,$args){
$post_id = $args['post_id'];

$posts = Posts::find($post_id);

if($posts){

$board_slug = $posts->board->slug;

$thread_id = $posts->thread_id;

$thread_title = $posts->thread->name;

$patterns = array(
"/:(.*?):/i", //Emoji
"/&amp;gt;&amp;gt;(\d*)/i", // Quotes Posts
"/(\s|>|^)(https?:[^\s<]*)/i", // oEmebed
"/^&amp;gt;(.*)/i", // Quotes
"/&lt;br \/&gt;/i", // Br Tag
"/(\[b\])(.*?)(\[\/b\])/",
"/(\[i\])(.*?)(\[\/i\])/",
"/(\[u\])(.*?)(\[\/u\])/",
"/(\[s\])(.*?)(\[\/s\])/",
"/(\[spoiler\])(.*?)(\[\/spoiler\])/",
"/(\[img\])(.*?)(\[\/img\])/",
);
$replacements = array(
"<i class=\"twa twa-lg twa_$1\" title=\"$0\"></i>", //Emoji
"<a href='#$1' class='quote'>&gt;&gt; $1</a>", // Post Quotes
"$1<a href=\"$2\" id=\"embed\" class=\"embed-responsive embed-responsive-16by9\">$2</a>", // oEmebed
"<span class='quotes'>&gt; <q>$1</q></span>", // Self Quotes
"<br/>", // Self Quotes
"<strong>$2</strong>",
"<em>$2</em>",
"<u>$2</u>",
"<strike>$2</strike>",
"<span class=\"spoiler\">$2</span>",
"<img src=\"$2\" alt=\"$2\"/>",
);

$text = preg_replace($patterns,$replacements,htmlspecialchars($posts['content']));

} else{

return false;
}

return Response::json($posts);
}

/* Ajax Delete Post */
public function post_delete($f3){

$post_id = $f3->get("POST.post_id");

if(isset($post_id)){

if(count($post_id) > 1){

foreach($post_id as $post_number){

$post = Posts::find($post_number);

if($post->delete()){
$msg = array("success" => true,"msg" => "Your Message has been deleted. :)");
}

}

} else {
$post = Posts::find($post_id[0]);

if($post->delete()){
$msg = array("success" => true,"msg" => "Your Message has been deleted. :)");
}

}

} else {
$msg = array("error" => true,"msg" => "Unable to Delete Selected Post");
}


return Response::json($msg);
}


/* Loading Post Data */
public function post_loader($f3,$args){

$board_slug = $args['board_slug'];

$boards = Boards::where('slug',$board_slug)->first();

$board_title = $boards->name;

$board_slug = $boards->slug;

$board_id = $boards->id;

$threads = Threads::find($args['thread_id']);

$thread_id = $threads->id;
$thread_title = $threads->name;

$post_id = $f3->get('GET.post_id');

$results = Posts::where('thread_id' ,$thread_id)->where('id' ,'>', $post_id)->get();

$total_poster = Posts::groupBy("ip")->count();

$total_images = Photos::total_images($thread_id);

$total_reply = Posts::where(array('thread_id' => $thread_id))->count();

$result = array();

foreach ($results as $posts) {
$post_id = $posts['id'];

$get_poster_id = $posts['user_id'];

$img_id = $posts['img'];

$check_is_admin = User::check_is_admin($get_poster_id);

if($check_is_admin > 0){ $class = "admin"; } else { $class ="name";}

if(!empty($posts['user_name'])) {
$post_by = htmlspecialchars($posts['user_name']);
}
else {
$post_by = "Anonymous";
}

$patterns = array(
"/:(.*?):/i", //Emoji
"/&amp;gt;&amp;gt;(\d*)/i", // Quotes Posts
"/(\s|>|^)(https?:[^\s<]*)/i", // oEmebed
"/^&amp;gt;(.*)/i", // Quotes
"/&lt;br \/&gt;/i", // Br Tag
"/(\[b\])(.*?)(\[\/b\])/",
"/(\[i\])(.*?)(\[\/i\])/",
"/(\[u\])(.*?)(\[\/u\])/",
"/(\[s\])(.*?)(\[\/s\])/",
"/(\[spoiler\])(.*?)(\[\/spoiler\])/",
"/(\[img\])(.*?)(\[\/img\])/",
);
$replacements = array(
"<i class=\"twa twa-lg twa_$1\" title=\"$0\"></i>", //Emoji
"<a href='#$1' class='quote'>&gt;&gt; $1</a>", // Post Quotes
"$1<a href=\"$2\" id=\"embed\" class=\"embed-responsive embed-responsive-16by9\">$2</a>", // oEmebed
"<span class='quotes'>&gt; <q>$1</q></span>", // Self Quotes
"<br/>", // Self Quotes
"<strong>$2</strong>",
"<em>$2</em>",
"<u>$2</u>",
"<strike>$2</strike>",
"<span class=\"spoiler\">$2</span>",
"<img src=\"$2\" alt=\"$2\"/>",
);

$text = preg_replace($patterns,$replacements,htmlspecialchars($posts['content']));

$post_content = $text;

$get_photos = Photos::where(array('post_id' => $post_id))->get();

$photo_list = array();

if(count($get_photos) > 1){
foreach($get_photos as $photo){
$fileName = $photo['file_name'];
$org_file_name = $photo['original_name'];
$file_size = formatSizeUnits($photo['size']);
$file_pixels = $photo['pixels'];
$photo_list[] = array(
"file_name" => $fileName,
"original_name" => $org_file_name,
"size" => $file_size,
"pixels" => $file_pixels
);
}
} else {
foreach($get_photos as $photo){
$fileName = $photo['file_name'];
$org_file_name = $photo['original_name'];
$file_size = formatSizeUnits($photo['size']);
$file_pixels = $photo['pixels'];
}
}

$post_time = $posts['created_at']->format('m/d/y (D) H:i:s');

$ago_post_time = nicetime($posts['created_at']);

if(count($get_photos) !== 0 && count($get_photos) < 2){
$data = array(
"id" => $post_id,
"class_name" => $class,
"board_slug" => $board_slug,
"thread_id" => $thread_id,
"post_by" => $post_by,
"post_time" => $post_time,
"ago_post_time" => $ago_post_time,
"post_content" => $post_content,
"file_name" => $fileName,
"original_name" => $org_file_name,
"size" => $file_size,
"pixels" => $file_pixels,
"total_reply" => $total_reply,
"total_images" => $total_images,
"total_poster" => $total_poster
);
} 
elseif(count($get_photos) > 0){
$data = array(
"id" => $post_id,
"class_name" => $class,
"board_slug" => $board_slug,
"thread_id" => $thread_id,
"post_by" => $post_by,
"post_time" => $post_time,
"ago_post_time" => $ago_post_time,
"gallery" => true,
"photos" => $photo_list,
"post_content" => $post_content,
"total_reply" => $total_reply,
"total_images" => $total_images,
"total_poster" => $total_poster
);
}

else {
$data = array(
"id" => $post_id,
"class_name" => $class,
"board_slug" => $board_slug,
"thread_id" => $thread_id,
"post_by" => $post_by,
"post_time" => $post_time,
"ago_post_time" => $ago_post_time,
"post_content" => $post_content,
"total_reply" => $total_reply,
"total_images" => $total_images,
"total_poster" => $total_poster
);
}

array_push($result,$data);

$json_data = $result;
}

if($results->isEmpty()){ 
$json_data = array("success" => false, "msg" => "No New Posts.");
return Response::json($json_data); 
} else{ 
return Response::json(['success' => true,'posts' => $json_data]);
}
}

/* Emoji List */
public function emoji(){

$emoji = array(
array('value' => 'smile:','code' => 'smile', 'text' => 'Smile'),
array('value' => 'laughing:','code' => 'laughing', 'text' => 'Laughing'),
array('value' => 'blush:','code' => 'blush', 'text' => 'Blush'),
array('value' => 'smiley:','code' => 'smiley', 'text' => 'Smiley'),
array('value' => 'relaxed:','code' => 'relaxed', 'text' => 'Relaxed'),
array('value' => 'smirk:','code' => 'smirk', 'text' => 'Smirk'),
array('value' => 'heart_eyes:','code' => 'heart_eyes', 'text' => 'Heart Eyes'),
array('value' => 'kissing_heart:','code' => 'kissing_heart', 'text' => 'Kissing Heart'),
array('value' => 'kissing_closed_eyes:','code' => 'kissing_closed_eyes', 'text' => 'Kissing Closed Eyes'),
array('value' => 'flushed:','code' => 'flushed', 'text' => 'Flushed'),
array('value' => 'relieved:','code' => 'relieved', 'text' => 'Relieved'),
array('value' => 'satisfied:','code' => 'satisfied', 'text' => 'Satisfied'),
array('value' => 'grin:','code' => 'grin', 'text' => 'Grin'),
array('value' => 'wink:','code' => 'wink', 'text' => 'Wink'),
array('value' => 'stuck_out_tongue_winking_eye:','code' => 'stuck_out_tongue_winking_eye', 'text' => 'Stuck Out Tongue Winking Eye'),
array('value' => 'stuck_out_tongue_closed_eyes:','code' => 'stuck_out_tongue_closed_eyes', 'text' => 'Stuck Out Tongue Closed Eyes'),
array('value' => 'grinning:','code' => 'grinning', 'text' => 'Grinning'),
array('value' => 'kissing:','code' => 'kissing', 'text' => 'Kissing'),
array('value' => 'kissing_smiling_eyes:','code' => 'kissing_smiling_eyes', 'text' => 'Kissing Smiling Eyes'),
array('value' => 'stuck_out_tongue:','code' => 'stuck_out_tongue', 'text' => 'Stuck Out Tongue'),
array('value' => 'sleeping:','code' => 'sleeping', 'text' => 'Sleeping'),
array('value' => 'worried:','code' => 'worried', 'text' => 'Worried'),
array('value' => 'frowning:','code' => 'frowning', 'text' => 'Frowning'),
array('value' => 'anguished:','code' => 'anguished', 'text' => 'Anguished'),
array('value' => 'open_mouth:','code' => 'open_mouth', 'text' => 'Open Mouth'),
array('value' => 'grimacing:','code' => 'grimacing', 'text' => 'Grimacing'),
array('value' => 'confused:','code' => 'confused', 'text' => 'Confused'),
array('value' => 'hushed:','code' => 'hushed', 'text' => 'Hushed'),
array('value' => 'expressionless:','code' => 'expressionless', 'text' => 'Expressionless'),
array('value' => 'unamused:','code' => 'unamused', 'text' => 'Unamused'),
array('value' => 'sweat_smile:','code' => 'sweat_smile', 'text' => 'Sweat Smile'),
array('value' => 'sweat:','code' => 'sweat', 'text' => 'Sweat'),
array('value' => 'weary:','code' => 'weary', 'text' => 'Weary'),
array('value' => 'pensive:','code' => 'pensive', 'text' => 'Pensive'),
array('value' => 'disappointed:','code' => 'disappointed', 'text' => 'Disappointed'),
array('value' => 'confounded:','code' => 'confounded', 'text' => 'Confounded'),
array('value' => 'fearful:','code' => 'fearful', 'text' => 'Fearful'),
array('value' => 'cold_sweat:','code' => 'cold_sweat', 'text' => 'Cold Sweat'),
array('value' => 'persevere:','code' => 'persevere', 'text' => 'Persevere'),
array('value' => 'cry:','code' => 'cry', 'text' => 'Cry'),
array('value' => 'sob:','code' => 'sob', 'text' => 'Sob'),
array('value' => 'joy:','code' => 'joy', 'text' => 'Joy'),
array('value' => 'astonished:','code' => 'astonished', 'text' => 'Astonished'),
array('value' => 'scream:','code' => 'scream', 'text' => 'Scream'),
array('value' => 'tired_face:','code' => 'tired_face', 'text' => 'Tired Face'),
array('value' => 'angry:','code' => 'angry', 'text' => 'Angry'),
array('value' => 'rage:','code' => 'rage', 'text' => 'Rage'),
array('value' => 'triumph:','code' => 'triumph', 'text' => 'Triumph'),
array('value' => 'sleepy:','code' => 'sleepy', 'text' => 'Sleepy'),
array('value' => 'yum:','code' => 'yum', 'text' => 'Yum'),
array('value' => 'mask:','code' => 'mask', 'text' => 'Mask'),
array('value' => 'sunglasses:','code' => 'sunglasses', 'text' => 'Sunglasses'),
array('value' => 'dizzy_face:','code' => 'dizzy_face', 'text' => 'Dizzy Face'),
array('value' => 'imp:','code' => 'imp', 'text' => 'Imp'),
array('value' => 'smiling_imp:','code' => 'smiling_imp', 'text' => 'Smiling Imp'),
array('value' => 'neutral_face:','code' => 'neutral_face', 'text' => 'Neutral Face'),
array('value' => 'no_mouth:','code' => 'no_mouth', 'text' => 'No Mouth'),
array('value' => 'innocent:','code' => 'innocent', 'text' => 'Innocent'),
array('value' => 'alien:','code' => 'alien', 'text' => 'Alien'),
array('value' => 'yellow_heart:','code' => 'yellow_heart', 'text' => 'Yellow Heart'),
array('value' => 'blue_heart:','code' => 'blue_heart', 'text' => 'Blue Heart'),
array('value' => 'purple_heart:','code' => 'purple_heart', 'text' => 'Purple Heart'),
array('value' => 'heart:','code' => 'heart', 'text' => 'Heart'),
array('value' => 'green_heart:','code' => 'green_heart', 'text' => 'Green Heart'),
array('value' => 'broken_heart:','code' => 'broken_heart', 'text' => 'Broken Heart'),
array('value' => 'heartbeat:','code' => 'heartbeat', 'text' => 'Heartbeat'),
array('value' => 'heartpulse:','code' => 'heartpulse', 'text' => 'Heartpulse'),
array('value' => 'two_hearts:','code' => 'two_hearts', 'text' => 'Two Hearts'),
array('value' => 'revolving_hearts:','code' => 'revolving_hearts', 'text' => 'Revolving Hearts'),
array('value' => 'cupid:','code' => 'cupid', 'text' => 'Cupid'),
array('value' => 'sparkling_heart:','code' => 'sparkling_heart', 'text' => 'Sparkling Heart'),
array('value' => 'sparkles:','code' => 'sparkles', 'text' => 'Sparkles'),
array('value' => 'star:','code' => 'star', 'text' => 'Star'),
array('value' => 'star2:','code' => 'star2', 'text' => 'Star2'),
array('value' => 'dizzy:','code' => 'dizzy', 'text' => 'Dizzy'),
array('value' => 'boom:','code' => 'boom', 'text' => 'Boom'),
array('value' => 'anger:','code' => 'anger', 'text' => 'Anger'),
array('value' => 'exclamation:','code' => 'exclamation', 'text' => 'Exclamation'),
array('value' => 'question:','code' => 'question', 'text' => 'Question'),
array('value' => 'grey_exclamation:','code' => 'grey_exclamation', 'text' => 'Grey Exclamation'),
array('value' => 'grey_question:','code' => 'grey_question', 'text' => 'Grey Question'),
array('value' => 'zzz:','code' => 'zzz', 'text' => 'Zzz'),
array('value' => 'dash:','code' => 'dash', 'text' => 'Dash'),
array('value' => 'sweat_drops:','code' => 'sweat_drops', 'text' => 'Sweat Drops'),
array('value' => 'notes:','code' => 'notes', 'text' => 'Notes'),
array('value' => 'musical_note:','code' => 'musical_note', 'text' => 'Musical Note'),
array('value' => 'fire:','code' => 'fire', 'text' => 'Fire'),
array('value' => 'poop:','code' => 'poop', 'text' => 'Poop'),
array('value' => 'thumbsup:','code' => 'thumbsup', 'text' => 'Thumbsup'),
array('value' => 'thumbsdown:','code' => 'thumbsdown', 'text' => 'Thumbsdown'),
array('value' => 'ok_hand:','code' => 'ok_hand', 'text' => 'Ok Hand'),
array('value' => 'punch:','code' => 'punch', 'text' => 'Punch'),
array('value' => 'fist:','code' => 'fist', 'text' => 'Fist'),
array('value' => 'v:','code' => 'v', 'text' => 'V'),
array('value' => 'wave:','code' => 'wave', 'text' => 'Wave'),
array('value' => 'hand:','code' => 'hand', 'text' => 'Hand'),
array('value' => 'open_hands:','code' => 'open_hands', 'text' => 'Open Hands'),
array('value' => 'point_up:','code' => 'point_up', 'text' => 'Point Up'),
array('value' => 'point_down:','code' => 'point_down', 'text' => 'Point Down'),
array('value' => 'point_left:','code' => 'point_left', 'text' => 'Point Left'),
array('value' => 'point_right:','code' => 'point_right', 'text' => 'Point Right'),
array('value' => 'raised_hands:','code' => 'raised_hands', 'text' => 'Raised Hands'),
array('value' => 'pray:','code' => 'pray', 'text' => 'Pray'),
array('value' => 'point_up_2:','code' => 'point_up_2', 'text' => 'Point Up 2'),
array('value' => 'clap:','code' => 'clap', 'text' => 'Clap'),
array('value' => 'muscle:','code' => 'muscle', 'text' => 'Muscle'),
array('value' => 'walking:','code' => 'walking', 'text' => 'Walking'),
array('value' => 'runner:','code' => 'runner', 'text' => 'Runner'),
array('value' => 'couple:','code' => 'couple', 'text' => 'Couple'),
array('value' => 'family:','code' => 'family', 'text' => 'Family'),
array('value' => 'two_men_holding_hands:','code' => 'two_men_holding_hands', 'text' => 'Two Men Holding Hands'),
array('value' => 'two_women_holding_hands:','code' => 'two_women_holding_hands', 'text' => 'Two Women Holding Hands'),
array('value' => 'dancer:','code' => 'dancer', 'text' => 'Dancer'),
array('value' => 'dancers:','code' => 'dancers', 'text' => 'Dancers'),
array('value' => 'ok_woman:','code' => 'ok_woman', 'text' => 'Ok Woman'),
array('value' => 'no_good:','code' => 'no_good', 'text' => 'No Good'),
array('value' => 'information_desk_person:','code' => 'information_desk_person', 'text' => 'Information Desk Person'),
array('value' => 'raised_hand:','code' => 'raised_hand', 'text' => 'Raised Hand'),
array('value' => 'bride_with_veil:','code' => 'bride_with_veil', 'text' => 'Bride With Veil'),
array('value' => 'person_with_pouting_face:','code' => 'person_with_pouting_face', 'text' => 'Person With Pouting Face'),
array('value' => 'person_frowning:','code' => 'person_frowning', 'text' => 'Person Frowning'),
array('value' => 'bow:','code' => 'bow', 'text' => 'Bow'),
array('value' => 'couplekiss:','code' => 'couplekiss', 'text' => 'Couplekiss'),
array('value' => 'couple_with_heart:','code' => 'couple_with_heart', 'text' => 'Couple With Heart'),
array('value' => 'massage:','code' => 'massage', 'text' => 'Massage'),
array('value' => 'haircut:','code' => 'haircut', 'text' => 'Haircut'),
array('value' => 'nail_care:','code' => 'nail_care', 'text' => 'Nail Care'),
array('value' => 'boy:','code' => 'boy', 'text' => 'Boy'),
array('value' => 'girl:','code' => 'girl', 'text' => 'Girl'),
array('value' => 'woman:','code' => 'woman', 'text' => 'Woman'),
array('value' => 'man:','code' => 'man', 'text' => 'Man'),
array('value' => 'baby:','code' => 'baby', 'text' => 'Baby'),
array('value' => 'older_woman:','code' => 'older_woman', 'text' => 'Older Woman'),
array('value' => 'older_man:','code' => 'older_man', 'text' => 'Older Man'),
array('value' => 'person_with_blond_hair:','code' => 'person_with_blond_hair', 'text' => 'Person With Blond Hair'),
array('value' => 'man_with_gua_pi_mao:','code' => 'man_with_gua_pi_mao', 'text' => 'Man With Gua Pi Mao'),
array('value' => 'man_with_turban:','code' => 'man_with_turban', 'text' => 'Man With Turban'),
array('value' => 'construction_worker:','code' => 'construction_worker', 'text' => 'Construction Worker'),
array('value' => 'cop:','code' => 'cop', 'text' => 'Cop'),
array('value' => 'angel:','code' => 'angel', 'text' => 'Angel'),
array('value' => 'princess:','code' => 'princess', 'text' => 'Princess'),
array('value' => 'smiley_cat:','code' => 'smiley_cat', 'text' => 'Smiley Cat'),
array('value' => 'smile_cat:','code' => 'smile_cat', 'text' => 'Smile Cat'),
array('value' => 'heart_eyes_cat:','code' => 'heart_eyes_cat', 'text' => 'Heart Eyes Cat'),
array('value' => 'kissing_cat:','code' => 'kissing_cat', 'text' => 'Kissing Cat'),
array('value' => 'smirk_cat:','code' => 'smirk_cat', 'text' => 'Smirk Cat'),
array('value' => 'scream_cat:','code' => 'scream_cat', 'text' => 'Scream Cat'),
array('value' => 'crying_cat_face:','code' => 'crying_cat_face', 'text' => 'Crying Cat Face'),
array('value' => 'joy_cat:','code' => 'joy_cat', 'text' => 'Joy Cat'),
array('value' => 'pouting_cat:','code' => 'pouting_cat', 'text' => 'Pouting Cat'),
array('value' => 'japanese_ogre:','code' => 'japanese_ogre', 'text' => 'Japanese Ogre'),
array('value' => 'japanese_goblin:','code' => 'japanese_goblin', 'text' => 'Japanese Goblin'),
array('value' => 'see_no_evil:','code' => 'see_no_evil', 'text' => 'See No Evil'),
array('value' => 'hear_no_evil:','code' => 'hear_no_evil', 'text' => 'Hear No Evil'),
array('value' => 'speak_no_evil:','code' => 'speak_no_evil', 'text' => 'Speak No Evil'),
array('value' => 'guardsman:','code' => 'guardsman', 'text' => 'Guardsman'),
array('value' => 'skull:','code' => 'skull', 'text' => 'Skull'),
array('value' => 'feet:','code' => 'feet', 'text' => 'Feet'),
array('value' => 'lips:','code' => 'lips', 'text' => 'Lips'),
array('value' => 'kiss:','code' => 'kiss', 'text' => 'Kiss'),
array('value' => 'droplet:','code' => 'droplet', 'text' => 'Droplet'),
array('value' => 'ear:','code' => 'ear', 'text' => 'Ear'),
array('value' => 'eyes:','code' => 'eyes', 'text' => 'Eyes'),
array('value' => 'nose:','code' => 'nose', 'text' => 'Nose'),
array('value' => 'tongue:','code' => 'tongue', 'text' => 'Tongue'),
array('value' => 'love_letter:','code' => 'love_letter', 'text' => 'Love Letter'),
array('value' => 'bust_in_silhouette:','code' => 'bust_in_silhouette', 'text' => 'Bust In Silhouette'),
array('value' => 'busts_in_silhouette:','code' => 'busts_in_silhouette', 'text' => 'Busts In Silhouette'),
array('value' => 'speech_balloon:','code' => 'speech_balloon', 'text' => 'Speech Balloon'),
array('value' => 'thought_balloon:','code' => 'thought_balloon', 'text' => 'Thought Balloon'),
array('value' => 'sunny:','code' => 'sunny', 'text' => 'Sunny'),
array('value' => 'umbrella:','code' => 'umbrella', 'text' => 'Umbrella'),
array('value' => 'cloud:','code' => 'cloud', 'text' => 'Cloud'),
array('value' => 'snowflake:','code' => 'snowflake', 'text' => 'Snowflake'),
array('value' => 'snowman:','code' => 'snowman', 'text' => 'Snowman'),
array('value' => 'zap:','code' => 'zap', 'text' => 'Zap'),
array('value' => 'cyclone:','code' => 'cyclone', 'text' => 'Cyclone'),
array('value' => 'foggy:','code' => 'foggy', 'text' => 'Foggy'),
array('value' => 'ocean:','code' => 'ocean', 'text' => 'Ocean'),
array('value' => 'cat:','code' => 'cat', 'text' => 'Cat'),
array('value' => 'dog:','code' => 'dog', 'text' => 'Dog'),
array('value' => 'mouse:','code' => 'mouse', 'text' => 'Mouse'),
array('value' => 'hamster:','code' => 'hamster', 'text' => 'Hamster'),
array('value' => 'rabbit:','code' => 'rabbit', 'text' => 'Rabbit'),
array('value' => 'wolf:','code' => 'wolf', 'text' => 'Wolf'),
array('value' => 'frog:','code' => 'frog', 'text' => 'Frog'),
array('value' => 'tiger:','code' => 'tiger', 'text' => 'Tiger'),
array('value' => 'koala:','code' => 'koala', 'text' => 'Koala'),
array('value' => 'bear:','code' => 'bear', 'text' => 'Bear'),
array('value' => 'pig:','code' => 'pig', 'text' => 'Pig'),
array('value' => 'pig_nose:','code' => 'pig_nose', 'text' => 'Pig Nose'),
array('value' => 'cow:','code' => 'cow', 'text' => 'Cow'),
array('value' => 'boar:','code' => 'boar', 'text' => 'Boar'),
array('value' => 'monkey_face:','code' => 'monkey_face', 'text' => 'Monkey Face'),
array('value' => 'monkey:','code' => 'monkey', 'text' => 'Monkey'),
array('value' => 'horse:','code' => 'horse', 'text' => 'Horse'),
array('value' => 'racehorse:','code' => 'racehorse', 'text' => 'Racehorse'),
array('value' => 'camel:','code' => 'camel', 'text' => 'Camel'),
array('value' => 'sheep:','code' => 'sheep', 'text' => 'Sheep'),
array('value' => 'elephant:','code' => 'elephant', 'text' => 'Elephant'),
array('value' => 'panda_face:','code' => 'panda_face', 'text' => 'Panda Face'),
array('value' => 'snake:','code' => 'snake', 'text' => 'Snake'),
array('value' => 'bird:','code' => 'bird', 'text' => 'Bird'),
array('value' => 'baby_chick:','code' => 'baby_chick', 'text' => 'Baby Chick'),
array('value' => 'hatched_chick:','code' => 'hatched_chick', 'text' => 'Hatched Chick'),
array('value' => 'hatching_chick:','code' => 'hatching_chick', 'text' => 'Hatching Chick'),
array('value' => 'chicken:','code' => 'chicken', 'text' => 'Chicken'),
array('value' => 'penguin:','code' => 'penguin', 'text' => 'Penguin'),
array('value' => 'turtle:','code' => 'turtle', 'text' => 'Turtle'),
array('value' => 'bug:','code' => 'bug', 'text' => 'Bug'),
array('value' => 'honeybee:','code' => 'honeybee', 'text' => 'Honeybee'),
array('value' => 'ant:','code' => 'ant', 'text' => 'Ant'),
array('value' => 'beetle:','code' => 'beetle', 'text' => 'Beetle'),
array('value' => 'snail:','code' => 'snail', 'text' => 'Snail'),
array('value' => 'octopus:','code' => 'octopus', 'text' => 'Octopus'),
array('value' => 'tropical_fish:','code' => 'tropical_fish', 'text' => 'Tropical Fish'),
array('value' => 'fish:','code' => 'fish', 'text' => 'Fish'),
array('value' => 'whale:','code' => 'whale', 'text' => 'Whale'),
array('value' => 'whale2:','code' => 'whale2', 'text' => 'Whale2'),
array('value' => 'dolphin:','code' => 'dolphin', 'text' => 'Dolphin'),
array('value' => 'cow2:','code' => 'cow2', 'text' => 'Cow2'),
array('value' => 'ram:','code' => 'ram', 'text' => 'Ram'),
array('value' => 'rat:','code' => 'rat', 'text' => 'Rat'),
array('value' => 'water_buffalo:','code' => 'water_buffalo', 'text' => 'Water Buffalo'),
array('value' => 'tiger2:','code' => 'tiger2', 'text' => 'Tiger2'),
array('value' => 'rabbit2:','code' => 'rabbit2', 'text' => 'Rabbit2'),
array('value' => 'dragon:','code' => 'dragon', 'text' => 'Dragon'),
array('value' => 'goat:','code' => 'goat', 'text' => 'Goat'),
array('value' => 'rooster:','code' => 'rooster', 'text' => 'Rooster'),
array('value' => 'dog2:','code' => 'dog2', 'text' => 'Dog2'),
array('value' => 'pig2:','code' => 'pig2', 'text' => 'Pig2'),
array('value' => 'mouse2:','code' => 'mouse2', 'text' => 'Mouse2'),
array('value' => 'ox:','code' => 'ox', 'text' => 'Ox'),
array('value' => 'dragon_face:','code' => 'dragon_face', 'text' => 'Dragon Face'),
array('value' => 'blowfish:','code' => 'blowfish', 'text' => 'Blowfish'),
array('value' => 'crocodile:','code' => 'crocodile', 'text' => 'Crocodile'),
array('value' => 'dromedary_camel:','code' => 'dromedary_camel', 'text' => 'Dromedary Camel'),
array('value' => 'leopard:','code' => 'leopard', 'text' => 'Leopard'),
array('value' => 'cat2:','code' => 'cat2', 'text' => 'Cat2'),
array('value' => 'poodle:','code' => 'poodle', 'text' => 'Poodle'),
array('value' => 'paw_prints:','code' => 'paw_prints', 'text' => 'Paw Prints'),
array('value' => 'bouquet:','code' => 'bouquet', 'text' => 'Bouquet'),
array('value' => 'cherry_blossom:','code' => 'cherry_blossom', 'text' => 'Cherry Blossom'),
array('value' => 'tulip:','code' => 'tulip', 'text' => 'Tulip'),
array('value' => 'four_leaf_clover:','code' => 'four_leaf_clover', 'text' => 'Four Leaf Clover'),
array('value' => 'rose:','code' => 'rose', 'text' => 'Rose'),
array('value' => 'sunflower:','code' => 'sunflower', 'text' => 'Sunflower'),
array('value' => 'hibiscus:','code' => 'hibiscus', 'text' => 'Hibiscus'),
array('value' => 'maple_leaf:','code' => 'maple_leaf', 'text' => 'Maple Leaf'),
array('value' => 'leaves:','code' => 'leaves', 'text' => 'Leaves'),
array('value' => 'fallen_leaf:','code' => 'fallen_leaf', 'text' => 'Fallen Leaf'),
array('value' => 'herb:','code' => 'herb', 'text' => 'Herb'),
array('value' => 'mushroom:','code' => 'mushroom', 'text' => 'Mushroom'),
array('value' => 'cactus:','code' => 'cactus', 'text' => 'Cactus'),
array('value' => 'palm_tree:','code' => 'palm_tree', 'text' => 'Palm Tree'),
array('value' => 'evergreen_tree:','code' => 'evergreen_tree', 'text' => 'Evergreen Tree'),
array('value' => 'deciduous_tree:','code' => 'deciduous_tree', 'text' => 'Deciduous Tree'),
array('value' => 'chestnut:','code' => 'chestnut', 'text' => 'Chestnut'),
array('value' => 'seedling:','code' => 'seedling', 'text' => 'Seedling'),
array('value' => 'blossom:','code' => 'blossom', 'text' => 'Blossom'),
array('value' => 'ear_of_rice:','code' => 'ear_of_rice', 'text' => 'Ear Of Rice'),
array('value' => 'shell:','code' => 'shell', 'text' => 'Shell'),
array('value' => 'globe_with_meridians:','code' => 'globe_with_meridians', 'text' => 'Globe With Meridians'),
array('value' => 'sun_with_face:','code' => 'sun_with_face', 'text' => 'Sun With Face'),
array('value' => 'full_moon_with_face:','code' => 'full_moon_with_face', 'text' => 'Full Moon With Face'),
array('value' => 'new_moon_with_face:','code' => 'new_moon_with_face', 'text' => 'New Moon With Face'),
array('value' => 'new_moon:','code' => 'new_moon', 'text' => 'New Moon'),
array('value' => 'waxing_crescent_moon:','code' => 'waxing_crescent_moon', 'text' => 'Waxing Crescent Moon'),
array('value' => 'first_quarter_moon:','code' => 'first_quarter_moon', 'text' => 'First Quarter Moon'),
array('value' => 'waxing_gibbous_moon:','code' => 'waxing_gibbous_moon', 'text' => 'Waxing Gibbous Moon'),
array('value' => 'full_moon:','code' => 'full_moon', 'text' => 'Full Moon'),
array('value' => 'waning_gibbous_moon:','code' => 'waning_gibbous_moon', 'text' => 'Waning Gibbous Moon'),
array('value' => 'last_quarter_moon:','code' => 'last_quarter_moon', 'text' => 'Last Quarter Moon'),
array('value' => 'waning_crescent_moon:','code' => 'waning_crescent_moon', 'text' => 'Waning Crescent Moon'),
array('value' => 'last_quarter_moon_with_face:','code' => 'last_quarter_moon_with_face', 'text' => 'Last Quarter Moon With Face'),
array('value' => 'first_quarter_moon_with_face:','code' => 'first_quarter_moon_with_face', 'text' => 'First Quarter Moon With Face'),
array('value' => 'moon:','code' => 'moon', 'text' => 'Moon'),
array('value' => 'earth_africa:','code' => 'earth_africa', 'text' => 'Earth Africa'),
array('value' => 'earth_americas:','code' => 'earth_americas', 'text' => 'Earth Americas'),
array('value' => 'earth_asia:','code' => 'earth_asia', 'text' => 'Earth Asia'),
array('value' => 'volcano:','code' => 'volcano', 'text' => 'Volcano'),
array('value' => 'milky_way:','code' => 'milky_way', 'text' => 'Milky Way'),
array('value' => 'partly_sunny:','code' => 'partly_sunny', 'text' => 'Partly Sunny'),
array('value' => 'bamboo:','code' => 'bamboo', 'text' => 'Bamboo'),
array('value' => 'gift_heart:','code' => 'gift_heart', 'text' => 'Gift Heart'),
array('value' => 'dolls:','code' => 'dolls', 'text' => 'Dolls'),
array('value' => 'school_satchel:','code' => 'school_satchel', 'text' => 'School Satchel'),
array('value' => 'mortar_board:','code' => 'mortar_board', 'text' => 'Mortar Board'),
array('value' => 'flags:','code' => 'flags', 'text' => 'Flags'),
array('value' => 'fireworks:','code' => 'fireworks', 'text' => 'Fireworks'),
array('value' => 'sparkler:','code' => 'sparkler', 'text' => 'Sparkler'),
array('value' => 'wind_chime:','code' => 'wind_chime', 'text' => 'Wind Chime'),
array('value' => 'rice_scene:','code' => 'rice_scene', 'text' => 'Rice Scene'),
array('value' => 'jack_o_lantern:','code' => 'jack_o_lantern', 'text' => 'Jack O Lantern'),
array('value' => 'ghost:','code' => 'ghost', 'text' => 'Ghost'),
array('value' => 'santa:','code' => 'santa', 'text' => 'Santa'),
array('value' => '8ball:','code' => '8ball', 'text' => '8ball'),
array('value' => 'alarm_clock:','code' => 'alarm_clock', 'text' => 'Alarm Clock'),
array('value' => 'apple:','code' => 'apple', 'text' => 'Apple'),
array('value' => 'art:','code' => 'art', 'text' => 'Art'),
array('value' => 'baby_bottle:','code' => 'baby_bottle', 'text' => 'Baby Bottle'),
array('value' => 'balloon:','code' => 'balloon', 'text' => 'Balloon'),
array('value' => 'banana:','code' => 'banana', 'text' => 'Banana'),
array('value' => 'bar_chart:','code' => 'bar_chart', 'text' => 'Bar Chart'),
array('value' => 'baseball:','code' => 'baseball', 'text' => 'Baseball'),
array('value' => 'basketball:','code' => 'basketball', 'text' => 'Basketball'),
array('value' => 'bath:','code' => 'bath', 'text' => 'Bath'),
array('value' => 'bathtub:','code' => 'bathtub', 'text' => 'Bathtub'),
array('value' => 'battery:','code' => 'battery', 'text' => 'Battery'),
array('value' => 'beer:','code' => 'beer', 'text' => 'Beer'),
array('value' => 'beers:','code' => 'beers', 'text' => 'Beers'),
array('value' => 'bell:','code' => 'bell', 'text' => 'Bell'),
array('value' => 'bento:','code' => 'bento', 'text' => 'Bento'),
array('value' => 'bicyclist:','code' => 'bicyclist', 'text' => 'Bicyclist'),
array('value' => 'bikini:','code' => 'bikini', 'text' => 'Bikini'),
array('value' => 'birthday:','code' => 'birthday', 'text' => 'Birthday'),
array('value' => 'black_joker:','code' => 'black_joker', 'text' => 'Black Joker'),
array('value' => 'black_nib:','code' => 'black_nib', 'text' => 'Black Nib'),
array('value' => 'blue_book:','code' => 'blue_book', 'text' => 'Blue Book'),
array('value' => 'bomb:','code' => 'bomb', 'text' => 'Bomb'),
array('value' => 'bookmark:','code' => 'bookmark', 'text' => 'Bookmark'),
array('value' => 'bookmark_tabs:','code' => 'bookmark_tabs', 'text' => 'Bookmark Tabs'),
array('value' => 'books:','code' => 'books', 'text' => 'Books'),
array('value' => 'boot:','code' => 'boot', 'text' => 'Boot'),
array('value' => 'bowling:','code' => 'bowling', 'text' => 'Bowling'),
array('value' => 'bread:','code' => 'bread', 'text' => 'Bread'),
array('value' => 'briefcase:','code' => 'briefcase', 'text' => 'Briefcase'),
array('value' => 'bulb:','code' => 'bulb', 'text' => 'Bulb'),
array('value' => 'cake:','code' => 'cake', 'text' => 'Cake'),
array('value' => 'calendar:','code' => 'calendar', 'text' => 'Calendar'),
array('value' => 'calling:','code' => 'calling', 'text' => 'Calling'),
array('value' => 'camera:','code' => 'camera', 'text' => 'Camera'),
array('value' => 'candy:','code' => 'candy', 'text' => 'Candy'),
array('value' => 'card_index:','code' => 'card_index', 'text' => 'Card Index'),
array('value' => 'cd:','code' => 'cd', 'text' => 'Cd'),
array('value' => 'chart_with_downwards_trend:','code' => 'chart_with_downwards_trend', 'text' => 'Chart With Downwards Trend'),
array('value' => 'chart_with_upwards_trend:','code' => 'chart_with_upwards_trend', 'text' => 'Chart With Upwards Trend'),
array('value' => 'cherries:','code' => 'cherries', 'text' => 'Cherries'),
array('value' => 'chocolate_bar:','code' => 'chocolate_bar', 'text' => 'Chocolate Bar'),
array('value' => 'christmas_tree:','code' => 'christmas_tree', 'text' => 'Christmas Tree'),
array('value' => 'clapper:','code' => 'clapper', 'text' => 'Clapper'),
array('value' => 'clipboard:','code' => 'clipboard', 'text' => 'Clipboard'),
array('value' => 'closed_book:','code' => 'closed_book', 'text' => 'Closed Book'),
array('value' => 'closed_lock_with_key:','code' => 'closed_lock_with_key', 'text' => 'Closed Lock With Key'),
array('value' => 'closed_umbrella:','code' => 'closed_umbrella', 'text' => 'Closed Umbrella'),
array('value' => 'clubs:','code' => 'clubs', 'text' => 'Clubs'),
array('value' => 'cocktail:','code' => 'cocktail', 'text' => 'Cocktail'),
array('value' => 'coffee:','code' => 'coffee', 'text' => 'Coffee'),
array('value' => 'computer:','code' => 'computer', 'text' => 'Computer'),
array('value' => 'confetti_ball:','code' => 'confetti_ball', 'text' => 'Confetti Ball'),
array('value' => 'cookie:','code' => 'cookie', 'text' => 'Cookie'),
array('value' => 'corn:','code' => 'corn', 'text' => 'Corn'),
array('value' => 'credit_card:','code' => 'credit_card', 'text' => 'Credit Card'),
array('value' => 'crown:','code' => 'crown', 'text' => 'Crown'),
array('value' => 'crystal_ball:','code' => 'crystal_ball', 'text' => 'Crystal Ball'),
array('value' => 'curry:','code' => 'curry', 'text' => 'Curry'),
array('value' => 'custard:','code' => 'custard', 'text' => 'Custard'),
array('value' => 'dango:','code' => 'dango', 'text' => 'Dango'),
array('value' => 'dart:','code' => 'dart', 'text' => 'Dart'),
array('value' => 'date:','code' => 'date', 'text' => 'Date'),
array('value' => 'diamonds:','code' => 'diamonds', 'text' => 'Diamonds'),
array('value' => 'dollar:','code' => 'dollar', 'text' => 'Dollar'),
array('value' => 'door:','code' => 'door', 'text' => 'Door'),
array('value' => 'doughnut:','code' => 'doughnut', 'text' => 'Doughnut'),
array('value' => 'dress:','code' => 'dress', 'text' => 'Dress'),
array('value' => 'dvd:','code' => 'dvd', 'text' => 'Dvd'),
array('value' => 'e_mail:','code' => 'e_mail', 'text' => 'E Mail'),
array('value' => 'egg:','code' => 'egg', 'text' => 'Egg'),
array('value' => 'eggplant:','code' => 'eggplant', 'text' => 'Eggplant'),
array('value' => 'electric_plug:','code' => 'electric_plug', 'text' => 'Electric Plug'),
array('value' => 'email:','code' => 'email', 'text' => 'Email'),
array('value' => 'euro:','code' => 'euro', 'text' => 'Euro'),
array('value' => 'eyeglasses:','code' => 'eyeglasses', 'text' => 'Eyeglasses'),
array('value' => 'fax:','code' => 'fax', 'text' => 'Fax'),
array('value' => 'file_folder:','code' => 'file_folder', 'text' => 'File Folder'),
array('value' => 'fish_cake:','code' => 'fish_cake', 'text' => 'Fish Cake'),
array('value' => 'fishing_pole_and_fish:','code' => 'fishing_pole_and_fish', 'text' => 'Fishing Pole And Fish'),
array('value' => 'flashlight:','code' => 'flashlight', 'text' => 'Flashlight'),
array('value' => 'floppy_disk:','code' => 'floppy_disk', 'text' => 'Floppy Disk'),
array('value' => 'flower_playing_cards:','code' => 'flower_playing_cards', 'text' => 'Flower Playing Cards'),
array('value' => 'football:','code' => 'football', 'text' => 'Football'),
array('value' => 'fork_and_knife:','code' => 'fork_and_knife', 'text' => 'Fork And Knife'),
array('value' => 'fried_shrimp:','code' => 'fried_shrimp', 'text' => 'Fried Shrimp'),
array('value' => 'fries:','code' => 'fries', 'text' => 'Fries'),
array('value' => 'game_die:','code' => 'game_die', 'text' => 'Game Die'),
array('value' => 'gem:','code' => 'gem', 'text' => 'Gem'),
array('value' => 'gift:','code' => 'gift', 'text' => 'Gift'),
array('value' => 'golf:','code' => 'golf', 'text' => 'Golf'),
array('value' => 'grapes:','code' => 'grapes', 'text' => 'Grapes'),
array('value' => 'green_apple:','code' => 'green_apple', 'text' => 'Green Apple'),
array('value' => 'green_book:','code' => 'green_book', 'text' => 'Green Book'),
array('value' => 'guitar:','code' => 'guitar', 'text' => 'Guitar'),
array('value' => 'gun:','code' => 'gun', 'text' => 'Gun'),
array('value' => 'hamburger:','code' => 'hamburger', 'text' => 'Hamburger'),
array('value' => 'hammer:','code' => 'hammer', 'text' => 'Hammer'),
array('value' => 'handbag:','code' => 'handbag', 'text' => 'Handbag'),
array('value' => 'headphones:','code' => 'headphones', 'text' => 'Headphones'),
array('value' => 'hearts:','code' => 'hearts', 'text' => 'Hearts'),
array('value' => 'high_brightness:','code' => 'high_brightness', 'text' => 'High Brightness'),
array('value' => 'high_heel:','code' => 'high_heel', 'text' => 'High Heel'),
array('value' => 'hocho:','code' => 'hocho', 'text' => 'Hocho'),
array('value' => 'honey_pot:','code' => 'honey_pot', 'text' => 'Honey Pot'),
array('value' => 'horse_racing:','code' => 'horse_racing', 'text' => 'Horse Racing'),
array('value' => 'hourglass:','code' => 'hourglass', 'text' => 'Hourglass'),
array('value' => 'hourglass_flowing_sand:','code' => 'hourglass_flowing_sand', 'text' => 'Hourglass Flowing Sand'),
array('value' => 'ice_cream:','code' => 'ice_cream', 'text' => 'Ice Cream'),
array('value' => 'icecream:','code' => 'icecream', 'text' => 'Icecream'),
array('value' => 'inbox_tray:','code' => 'inbox_tray', 'text' => 'Inbox Tray'),
array('value' => 'incoming_envelope:','code' => 'incoming_envelope', 'text' => 'Incoming Envelope'),
array('value' => 'iphone:','code' => 'iphone', 'text' => 'Iphone'),
array('value' => 'jeans:','code' => 'jeans', 'text' => 'Jeans'),
array('value' => 'key:','code' => 'key', 'text' => 'Key'),
array('value' => 'kimono:','code' => 'kimono', 'text' => 'Kimono'),
array('value' => 'ledger:','code' => 'ledger', 'text' => 'Ledger'),
array('value' => 'lemon:','code' => 'lemon', 'text' => 'Lemon'),
array('value' => 'lipstick:','code' => 'lipstick', 'text' => 'Lipstick'),
array('value' => 'lock:','code' => 'lock', 'text' => 'Lock'),
array('value' => 'lock_with_ink_pen:','code' => 'lock_with_ink_pen', 'text' => 'Lock With Ink Pen'),
array('value' => 'lollipop:','code' => 'lollipop', 'text' => 'Lollipop'),
array('value' => 'loop:','code' => 'loop', 'text' => 'Loop'),
array('value' => 'loudspeaker:','code' => 'loudspeaker', 'text' => 'Loudspeaker'),
array('value' => 'low_brightness:','code' => 'low_brightness', 'text' => 'Low Brightness'),
array('value' => 'mag:','code' => 'mag', 'text' => 'Mag'),
array('value' => 'mag_right:','code' => 'mag_right', 'text' => 'Mag Right'),
array('value' => 'mahjong:','code' => 'mahjong', 'text' => 'Mahjong'),
array('value' => 'mailbox:','code' => 'mailbox', 'text' => 'Mailbox'),
array('value' => 'mailbox_closed:','code' => 'mailbox_closed', 'text' => 'Mailbox Closed'),
array('value' => 'mailbox_with_mail:','code' => 'mailbox_with_mail', 'text' => 'Mailbox With Mail'),
array('value' => 'mailbox_with_no_mail:','code' => 'mailbox_with_no_mail', 'text' => 'Mailbox With No Mail'),
array('value' => 'mans_shoe:','code' => 'mans_shoe', 'text' => 'Mans Shoe'),
array('value' => 'meat_on_bone:','code' => 'meat_on_bone', 'text' => 'Meat On Bone'),
array('value' => 'mega:','code' => 'mega', 'text' => 'Mega'),
array('value' => 'melon:','code' => 'melon', 'text' => 'Melon'),
array('value' => 'memo:','code' => 'memo', 'text' => 'Memo'),
array('value' => 'microphone:','code' => 'microphone', 'text' => 'Microphone'),
array('value' => 'microscope:','code' => 'microscope', 'text' => 'Microscope'),
array('value' => 'minidisc:','code' => 'minidisc', 'text' => 'Minidisc'),
array('value' => 'money_with_wings:','code' => 'money_with_wings', 'text' => 'Money With Wings'),
array('value' => 'moneybag:','code' => 'moneybag', 'text' => 'Moneybag'),
array('value' => 'mountain_bicyclist:','code' => 'mountain_bicyclist', 'text' => 'Mountain Bicyclist'),
array('value' => 'movie_camera:','code' => 'movie_camera', 'text' => 'Movie Camera'),
array('value' => 'musical_keyboard:','code' => 'musical_keyboard', 'text' => 'Musical Keyboard'),
array('value' => 'musical_score:','code' => 'musical_score', 'text' => 'Musical Score'),
array('value' => 'mute:','code' => 'mute', 'text' => 'Mute'),
array('value' => 'name_badge:','code' => 'name_badge', 'text' => 'Name Badge'),
array('value' => 'necktie:','code' => 'necktie', 'text' => 'Necktie'),
array('value' => 'newspaper:','code' => 'newspaper', 'text' => 'Newspaper'),
array('value' => 'no_bell:','code' => 'no_bell', 'text' => 'No Bell'),
array('value' => 'notebook:','code' => 'notebook', 'text' => 'Notebook'),
array('value' => 'notebook_with_decorative_cover:','code' => 'notebook_with_decorative_cover', 'text' => 'Notebook With Decorative Cover'),
array('value' => 'nut_and_bolt:','code' => 'nut_and_bolt', 'text' => 'Nut And Bolt'),
array('value' => 'oden:','code' => 'oden', 'text' => 'Oden'),
array('value' => 'open_file_folder:','code' => 'open_file_folder', 'text' => 'Open File Folder'),
array('value' => 'orange_book:','code' => 'orange_book', 'text' => 'Orange Book'),
array('value' => 'outbox_tray:','code' => 'outbox_tray', 'text' => 'Outbox Tray'),
array('value' => 'page_facing_up:','code' => 'page_facing_up', 'text' => 'Page Facing Up'),
array('value' => 'page_with_curl:','code' => 'page_with_curl', 'text' => 'Page With Curl'),
array('value' => 'pager:','code' => 'pager', 'text' => 'Pager'),
array('value' => 'paperclip:','code' => 'paperclip', 'text' => 'Paperclip'),
array('value' => 'peach:','code' => 'peach', 'text' => 'Peach'),
array('value' => 'pear:','code' => 'pear', 'text' => 'Pear'),
array('value' => 'pencil2:','code' => 'pencil2', 'text' => 'Pencil2'),
array('value' => 'phone:','code' => 'phone', 'text' => 'Phone'),
array('value' => 'pill:','code' => 'pill', 'text' => 'Pill'),
array('value' => 'pineapple:','code' => 'pineapple', 'text' => 'Pineapple'),
array('value' => 'pizza:','code' => 'pizza', 'text' => 'Pizza'),
array('value' => 'postal_horn:','code' => 'postal_horn', 'text' => 'Postal Horn'),
array('value' => 'postbox:','code' => 'postbox', 'text' => 'Postbox'),
array('value' => 'pouch:','code' => 'pouch', 'text' => 'Pouch'),
array('value' => 'poultry_leg:','code' => 'poultry_leg', 'text' => 'Poultry Leg'),
array('value' => 'pound:','code' => 'pound', 'text' => 'Pound'),
array('value' => 'purse:','code' => 'purse', 'text' => 'Purse'),
array('value' => 'pushpin:','code' => 'pushpin', 'text' => 'Pushpin'),
array('value' => 'radio:','code' => 'radio', 'text' => 'Radio'),
array('value' => 'ramen:','code' => 'ramen', 'text' => 'Ramen'),
array('value' => 'ribbon:','code' => 'ribbon', 'text' => 'Ribbon'),
array('value' => 'rice:','code' => 'rice', 'text' => 'Rice'),
array('value' => 'rice_ball:','code' => 'rice_ball', 'text' => 'Rice Ball'),
array('value' => 'rice_cracker:','code' => 'rice_cracker', 'text' => 'Rice Cracker'),
array('value' => 'ring:','code' => 'ring', 'text' => 'Ring'),
array('value' => 'rugby_football:','code' => 'rugby_football', 'text' => 'Rugby Football'),
array('value' => 'running_shirt_with_sash:','code' => 'running_shirt_with_sash', 'text' => 'Running Shirt With Sash'),
array('value' => 'sake:','code' => 'sake', 'text' => 'Sake'),
array('value' => 'sandal:','code' => 'sandal', 'text' => 'Sandal'),
array('value' => 'satellite:','code' => 'satellite', 'text' => 'Satellite'),
array('value' => 'saxophone:','code' => 'saxophone', 'text' => 'Saxophone'),
array('value' => 'scissors:','code' => 'scissors', 'text' => 'Scissors'),
array('value' => 'scroll:','code' => 'scroll', 'text' => 'Scroll'),
array('value' => 'seat:','code' => 'seat', 'text' => 'Seat'),
array('value' => 'shaved_ice:','code' => 'shaved_ice', 'text' => 'Shaved Ice'),
array('value' => 'shirt:','code' => 'shirt', 'text' => 'Shirt'),
array('value' => 'shower:','code' => 'shower', 'text' => 'Shower'),
array('value' => 'ski:','code' => 'ski', 'text' => 'Ski'),
array('value' => 'smoking:','code' => 'smoking', 'text' => 'Smoking'),
array('value' => 'snowboarder:','code' => 'snowboarder', 'text' => 'Snowboarder'),
array('value' => 'soccer:','code' => 'soccer', 'text' => 'Soccer'),
array('value' => 'sound:','code' => 'sound', 'text' => 'Sound'),
array('value' => 'space_invader:','code' => 'space_invader', 'text' => 'Space Invader'),
array('value' => 'spades:','code' => 'spades', 'text' => 'Spades'),
array('value' => 'spaghetti:','code' => 'spaghetti', 'text' => 'Spaghetti'),
array('value' => 'speaker:','code' => 'speaker', 'text' => 'Speaker'),
array('value' => 'stew:','code' => 'stew', 'text' => 'Stew'),
array('value' => 'straight_ruler:','code' => 'straight_ruler', 'text' => 'Straight Ruler'),
array('value' => 'strawberry:','code' => 'strawberry', 'text' => 'Strawberry'),
array('value' => 'surfer:','code' => 'surfer', 'text' => 'Surfer'),
array('value' => 'sushi:','code' => 'sushi', 'text' => 'Sushi'),
array('value' => 'sweet_potato:','code' => 'sweet_potato', 'text' => 'Sweet Potato'),
array('value' => 'swimmer:','code' => 'swimmer', 'text' => 'Swimmer'),
array('value' => 'syringe:','code' => 'syringe', 'text' => 'Syringe'),
array('value' => 'tada:','code' => 'tada', 'text' => 'Tada'),
array('value' => 'tanabata_tree:','code' => 'tanabata_tree', 'text' => 'Tanabata Tree'),
array('value' => 'tangerine:','code' => 'tangerine', 'text' => 'Tangerine'),
array('value' => 'tea:','code' => 'tea', 'text' => 'Tea'),
array('value' => 'telephone_receiver:','code' => 'telephone_receiver', 'text' => 'Telephone Receiver'),
array('value' => 'telescope:','code' => 'telescope', 'text' => 'Telescope'),
array('value' => 'tennis:','code' => 'tennis', 'text' => 'Tennis'),
array('value' => 'toilet:','code' => 'toilet', 'text' => 'Toilet'),
array('value' => 'tomato:','code' => 'tomato', 'text' => 'Tomato'),
array('value' => 'tophat:','code' => 'tophat', 'text' => 'Tophat'),
array('value' => 'triangular_ruler:','code' => 'triangular_ruler', 'text' => 'Triangular Ruler'),
array('value' => 'trophy:','code' => 'trophy', 'text' => 'Trophy'),
array('value' => 'tropical_drink:','code' => 'tropical_drink', 'text' => 'Tropical Drink'),
array('value' => 'trumpet:','code' => 'trumpet', 'text' => 'Trumpet'),
array('value' => 'tv:','code' => 'tv', 'text' => 'Tv'),
array('value' => 'unlock:','code' => 'unlock', 'text' => 'Unlock'),
array('value' => 'vhs:','code' => 'vhs', 'text' => 'Vhs'),
array('value' => 'video_camera:','code' => 'video_camera', 'text' => 'Video Camera'),
array('value' => 'video_game:','code' => 'video_game', 'text' => 'Video Game'),
array('value' => 'violin:','code' => 'violin', 'text' => 'Violin'),
array('value' => 'watch:','code' => 'watch', 'text' => 'Watch'),
array('value' => 'watermelon:','code' => 'watermelon', 'text' => 'Watermelon'),
array('value' => 'wine_glass:','code' => 'wine_glass', 'text' => 'Wine Glass'),
array('value' => 'womans_clothes:','code' => 'womans_clothes', 'text' => 'Womans Clothes'),
array('value' => 'womans_hat:','code' => 'womans_hat', 'text' => 'Womans Hat'),
array('value' => 'wrench:','code' => 'wrench', 'text' => 'Wrench'),
array('value' => 'yen:','code' => 'yen', 'text' => 'Yen'),
array('value' => 'aerial_tramway:','code' => 'aerial_tramway', 'text' => 'Aerial Tramway'),
array('value' => 'airplane:','code' => 'airplane', 'text' => 'Airplane'),
array('value' => 'ambulance:','code' => 'ambulance', 'text' => 'Ambulance'),
array('value' => 'anchor:','code' => 'anchor', 'text' => 'Anchor'),
array('value' => 'articulated_lorry:','code' => 'articulated_lorry', 'text' => 'Articulated Lorry'),
array('value' => 'atm:','code' => 'atm', 'text' => 'Atm'),
array('value' => 'bank:','code' => 'bank', 'text' => 'Bank'),
array('value' => 'barber:','code' => 'barber', 'text' => 'Barber'),
array('value' => 'beginner:','code' => 'beginner', 'text' => 'Beginner'),
array('value' => 'bike:','code' => 'bike', 'text' => 'Bike'),
array('value' => 'blue_car:','code' => 'blue_car', 'text' => 'Blue Car'),
array('value' => 'boat:','code' => 'boat', 'text' => 'Boat'),
array('value' => 'bridge_at_night:','code' => 'bridge_at_night', 'text' => 'Bridge At Night'),
array('value' => 'bullettrain_front:','code' => 'bullettrain_front', 'text' => 'Bullettrain Front'),
array('value' => 'bullettrain_side:','code' => 'bullettrain_side', 'text' => 'Bullettrain Side'),
array('value' => 'bus:','code' => 'bus', 'text' => 'Bus'),
array('value' => 'busstop:','code' => 'busstop', 'text' => 'Busstop'),
array('value' => 'car:','code' => 'car', 'text' => 'Car'),
array('value' => 'carousel_horse:','code' => 'carousel_horse', 'text' => 'Carousel Horse'),
array('value' => 'checkered_flag:','code' => 'checkered_flag', 'text' => 'Checkered Flag'),
array('value' => 'church:','code' => 'church', 'text' => 'Church'),
array('value' => 'circus_tent:','code' => 'circus_tent', 'text' => 'Circus Tent'),
array('value' => 'city_sunrise:','code' => 'city_sunrise', 'text' => 'City Sunrise'),
array('value' => 'city_sunset:','code' => 'city_sunset', 'text' => 'City Sunset'),
array('value' => 'construction:','code' => 'construction', 'text' => 'Construction'),
array('value' => 'convenience_store:','code' => 'convenience_store', 'text' => 'Convenience Store'),
array('value' => 'crossed_flags:','code' => 'crossed_flags', 'text' => 'Crossed Flags'),
array('value' => 'department_store:','code' => 'department_store', 'text' => 'Department Store'),
array('value' => 'european_castle:','code' => 'european_castle', 'text' => 'European Castle'),
array('value' => 'european_post_office:','code' => 'european_post_office', 'text' => 'European Post Office'),
array('value' => 'factory:','code' => 'factory', 'text' => 'Factory'),
array('value' => 'ferris_wheel:','code' => 'ferris_wheel', 'text' => 'Ferris Wheel'),
array('value' => 'fire_engine:','code' => 'fire_engine', 'text' => 'Fire Engine'),
array('value' => 'fountain:','code' => 'fountain', 'text' => 'Fountain'),
array('value' => 'fuelpump:','code' => 'fuelpump', 'text' => 'Fuelpump'),
array('value' => 'helicopter:','code' => 'helicopter', 'text' => 'Helicopter'),
array('value' => 'hospital:','code' => 'hospital', 'text' => 'Hospital'),
array('value' => 'hotel:','code' => 'hotel', 'text' => 'Hotel'),
array('value' => 'hotsprings:','code' => 'hotsprings', 'text' => 'Hotsprings'),
array('value' => 'house:','code' => 'house', 'text' => 'House'),
array('value' => 'house_with_garden:','code' => 'house_with_garden', 'text' => 'House With Garden'),
array('value' => 'japan:','code' => 'japan', 'text' => 'Japan'),
array('value' => 'japanese_castle:','code' => 'japanese_castle', 'text' => 'Japanese Castle'),
array('value' => 'light_rail:','code' => 'light_rail', 'text' => 'Light Rail'),
array('value' => 'love_hotel:','code' => 'love_hotel', 'text' => 'Love Hotel'),
array('value' => 'minibus:','code' => 'minibus', 'text' => 'Minibus'),
array('value' => 'monorail:','code' => 'monorail', 'text' => 'Monorail'),
array('value' => 'mount_fuji:','code' => 'mount_fuji', 'text' => 'Mount Fuji'),
array('value' => 'mountain_cableway:','code' => 'mountain_cableway', 'text' => 'Mountain Cableway'),
array('value' => 'mountain_railway:','code' => 'mountain_railway', 'text' => 'Mountain Railway'),
array('value' => 'moyai:','code' => 'moyai', 'text' => 'Moyai'),
array('value' => 'office:','code' => 'office', 'text' => 'Office'),
array('value' => 'oncoming_automobile:','code' => 'oncoming_automobile', 'text' => 'Oncoming Automobile'),
array('value' => 'oncoming_bus:','code' => 'oncoming_bus', 'text' => 'Oncoming Bus'),
array('value' => 'oncoming_police_car:','code' => 'oncoming_police_car', 'text' => 'Oncoming Police Car'),
array('value' => 'oncoming_taxi:','code' => 'oncoming_taxi', 'text' => 'Oncoming Taxi'),
array('value' => 'performing_arts:','code' => 'performing_arts', 'text' => 'Performing Arts'),
array('value' => 'police_car:','code' => 'police_car', 'text' => 'Police Car'),
array('value' => 'post_office:','code' => 'post_office', 'text' => 'Post Office'),
array('value' => 'railway_car:','code' => 'railway_car', 'text' => 'Railway Car'),
array('value' => 'rainbow:','code' => 'rainbow', 'text' => 'Rainbow'),
array('value' => 'rocket:','code' => 'rocket', 'text' => 'Rocket'),
array('value' => 'roller_coaster:','code' => 'roller_coaster', 'text' => 'Roller Coaster'),
array('value' => 'rotating_light:','code' => 'rotating_light', 'text' => 'Rotating Light'),
array('value' => 'round_pushpin:','code' => 'round_pushpin', 'text' => 'Round Pushpin'),
array('value' => 'rowboat:','code' => 'rowboat', 'text' => 'Rowboat'),
array('value' => 'school:','code' => 'school', 'text' => 'School'),
array('value' => 'ship:','code' => 'ship', 'text' => 'Ship'),
array('value' => 'slot_machine:','code' => 'slot_machine', 'text' => 'Slot Machine'),
array('value' => 'speedboat:','code' => 'speedboat', 'text' => 'Speedboat'),
array('value' => 'stars:','code' => 'stars', 'text' => 'Stars'),
array('value' => 'station:','code' => 'station', 'text' => 'Station'),
array('value' => 'statue_of_liberty:','code' => 'statue_of_liberty', 'text' => 'Statue Of Liberty'),
array('value' => 'steam_locomotive:','code' => 'steam_locomotive', 'text' => 'Steam Locomotive'),
array('value' => 'sunrise:','code' => 'sunrise', 'text' => 'Sunrise'),
array('value' => 'sunrise_over_mountains:','code' => 'sunrise_over_mountains', 'text' => 'Sunrise Over Mountains'),
array('value' => 'suspension_railway:','code' => 'suspension_railway', 'text' => 'Suspension Railway'),
array('value' => 'taxi:','code' => 'taxi', 'text' => 'Taxi'),
array('value' => 'tent:','code' => 'tent', 'text' => 'Tent'),
array('value' => 'ticket:','code' => 'ticket', 'text' => 'Ticket'),
array('value' => 'tokyo_tower:','code' => 'tokyo_tower', 'text' => 'Tokyo Tower'),
array('value' => 'tractor:','code' => 'tractor', 'text' => 'Tractor'),
array('value' => 'traffic_light:','code' => 'traffic_light', 'text' => 'Traffic Light'),
array('value' => 'train2:','code' => 'train2', 'text' => 'Train2'),
array('value' => 'tram:','code' => 'tram', 'text' => 'Tram'),
array('value' => 'triangular_flag_on_post:','code' => 'triangular_flag_on_post', 'text' => 'Triangular Flag On Post'),
array('value' => 'trolleybus:','code' => 'trolleybus', 'text' => 'Trolleybus'),
array('value' => 'truck:','code' => 'truck', 'text' => 'Truck'),
array('value' => 'vertical_traffic_light:','code' => 'vertical_traffic_light', 'text' => 'Vertical Traffic Light'),
array('value' => 'warning:','code' => 'warning', 'text' => 'Warning'),
array('value' => 'wedding:','code' => 'wedding', 'text' => 'Wedding'),
array('value' => 'jp:','code' => 'jp', 'text' => 'Jp'),
array('value' => 'kr:','code' => 'kr', 'text' => 'Kr'),
array('value' => 'cn:','code' => 'cn', 'text' => 'Cn'),
array('value' => 'us:','code' => 'us', 'text' => 'Us'),
array('value' => 'fr:','code' => 'fr', 'text' => 'Fr'),
array('value' => 'es:','code' => 'es', 'text' => 'Es'),
array('value' => 'it:','code' => 'it', 'text' => 'It'),
array('value' => 'ru:','code' => 'ru', 'text' => 'Ru'),
array('value' => 'gb:','code' => 'gb', 'text' => 'Gb'),
array('value' => 'de:','code' => 'de', 'text' => 'De'),
array('value' => '100:','code' => '100', 'text' => '100'),
array('value' => '1234:','code' => '1234', 'text' => '1234'),
array('value' => 'a:','code' => 'a', 'text' => 'A'),
array('value' => 'ab:','code' => 'ab', 'text' => 'Ab'),
array('value' => 'abc:','code' => 'abc', 'text' => 'Abc'),
array('value' => 'abcd:','code' => 'abcd', 'text' => 'Abcd'),
array('value' => 'accept:','code' => 'accept', 'text' => 'Accept'),
array('value' => 'aquarius:','code' => 'aquarius', 'text' => 'Aquarius'),
array('value' => 'aries:','code' => 'aries', 'text' => 'Aries'),
array('value' => 'arrow_backward:','code' => 'arrow_backward', 'text' => 'Arrow Backward'),
array('value' => 'arrow_double_down:','code' => 'arrow_double_down', 'text' => 'Arrow Double Down'),
array('value' => 'arrow_double_up:','code' => 'arrow_double_up', 'text' => 'Arrow Double Up'),
array('value' => 'arrow_down:','code' => 'arrow_down', 'text' => 'Arrow Down'),
array('value' => 'arrow_down_small:','code' => 'arrow_down_small', 'text' => 'Arrow Down Small'),
array('value' => 'arrow_forward:','code' => 'arrow_forward', 'text' => 'Arrow Forward'),
array('value' => 'arrow_heading_down:','code' => 'arrow_heading_down', 'text' => 'Arrow Heading Down'),
array('value' => 'arrow_heading_up:','code' => 'arrow_heading_up', 'text' => 'Arrow Heading Up'),
array('value' => 'arrow_left:','code' => 'arrow_left', 'text' => 'Arrow Left'),
array('value' => 'arrow_lower_left:','code' => 'arrow_lower_left', 'text' => 'Arrow Lower Left'),
array('value' => 'arrow_lower_right:','code' => 'arrow_lower_right', 'text' => 'Arrow Lower Right'),
array('value' => 'arrow_right:','code' => 'arrow_right', 'text' => 'Arrow Right'),
array('value' => 'arrow_right_hook:','code' => 'arrow_right_hook', 'text' => 'Arrow Right Hook'),
array('value' => 'arrow_up:','code' => 'arrow_up', 'text' => 'Arrow Up'),
array('value' => 'arrow_up_down:','code' => 'arrow_up_down', 'text' => 'Arrow Up Down'),
array('value' => 'arrow_up_small:','code' => 'arrow_up_small', 'text' => 'Arrow Up Small'),
array('value' => 'arrow_upper_left:','code' => 'arrow_upper_left', 'text' => 'Arrow Upper Left'),
array('value' => 'arrow_upper_right:','code' => 'arrow_upper_right', 'text' => 'Arrow Upper Right'),
array('value' => 'arrows_clockwise:','code' => 'arrows_clockwise', 'text' => 'Arrows Clockwise'),
array('value' => 'arrows_counterclockwise:','code' => 'arrows_counterclockwise', 'text' => 'Arrows Counterclockwise'),
array('value' => 'b:','code' => 'b', 'text' => 'B'),
array('value' => 'baby_symbol:','code' => 'baby_symbol', 'text' => 'Baby Symbol'),
array('value' => 'baggage_claim:','code' => 'baggage_claim', 'text' => 'Baggage Claim'),
array('value' => 'ballot_box_with_check:','code' => 'ballot_box_with_check', 'text' => 'Ballot Box With Check'),
array('value' => 'bangbang:','code' => 'bangbang', 'text' => 'Bangbang'),
array('value' => 'black_circle:','code' => 'black_circle', 'text' => 'Black Circle'),
array('value' => 'black_square_button:','code' => 'black_square_button', 'text' => 'Black Square Button'),
array('value' => 'cancer:','code' => 'cancer', 'text' => 'Cancer'),
array('value' => 'capital_abcd:','code' => 'capital_abcd', 'text' => 'Capital Abcd'),
array('value' => 'capricorn:','code' => 'capricorn', 'text' => 'Capricorn'),
array('value' => 'chart:','code' => 'chart', 'text' => 'Chart'),
array('value' => 'children_crossing:','code' => 'children_crossing', 'text' => 'Children Crossing'),
array('value' => 'cinema:','code' => 'cinema', 'text' => 'Cinema'),
array('value' => 'cl:','code' => 'cl', 'text' => 'Cl'),
array('value' => 'clock1:','code' => 'clock1', 'text' => 'Clock1'),
array('value' => 'clock10:','code' => 'clock10', 'text' => 'Clock10'),
array('value' => 'clock1030:','code' => 'clock1030', 'text' => 'Clock1030'),
array('value' => 'clock11:','code' => 'clock11', 'text' => 'Clock11'),
array('value' => 'clock1130:','code' => 'clock1130', 'text' => 'Clock1130'),
array('value' => 'clock12:','code' => 'clock12', 'text' => 'Clock12'),
array('value' => 'clock1230:','code' => 'clock1230', 'text' => 'Clock1230'),
array('value' => 'clock130:','code' => 'clock130', 'text' => 'Clock130'),
array('value' => 'clock2:','code' => 'clock2', 'text' => 'Clock2'),
array('value' => 'clock230:','code' => 'clock230', 'text' => 'Clock230'),
array('value' => 'clock3:','code' => 'clock3', 'text' => 'Clock3'),
array('value' => 'clock330:','code' => 'clock330', 'text' => 'Clock330'),
array('value' => 'clock4:','code' => 'clock4', 'text' => 'Clock4'),
array('value' => 'clock430:','code' => 'clock430', 'text' => 'Clock430'),
array('value' => 'clock5:','code' => 'clock5', 'text' => 'Clock5'),
array('value' => 'clock530:','code' => 'clock530', 'text' => 'Clock530'),
array('value' => 'clock6:','code' => 'clock6', 'text' => 'Clock6'),
array('value' => 'clock630:','code' => 'clock630', 'text' => 'Clock630'),
array('value' => 'clock7:','code' => 'clock7', 'text' => 'Clock7'),
array('value' => 'clock730:','code' => 'clock730', 'text' => 'Clock730'),
array('value' => 'clock8:','code' => 'clock8', 'text' => 'Clock8'),
array('value' => 'clock830:','code' => 'clock830', 'text' => 'Clock830'),
array('value' => 'clock9:','code' => 'clock9', 'text' => 'Clock9'),
array('value' => 'clock930:','code' => 'clock930', 'text' => 'Clock930'),
array('value' => 'congratulations:','code' => 'congratulations', 'text' => 'Congratulations'),
array('value' => 'cool:','code' => 'cool', 'text' => 'Cool'),
array('value' => 'copyright:','code' => 'copyright', 'text' => 'Copyright'),
array('value' => 'curly_loop:','code' => 'curly_loop', 'text' => 'Curly Loop'),
array('value' => 'currency_exchange:','code' => 'currency_exchange', 'text' => 'Currency Exchange'),
array('value' => 'customs:','code' => 'customs', 'text' => 'Customs'),
array('value' => 'diamond_shape_with_a_dot_inside:','code' => 'diamond_shape_with_a_dot_inside', 'text' => 'Diamond Shape With A Dot Inside'),
array('value' => 'do_not_litter:','code' => 'do_not_litter', 'text' => 'Do Not Litter'),
array('value' => 'eight:','code' => 'eight', 'text' => 'Eight'),
array('value' => 'eight_pointed_black_star:','code' => 'eight_pointed_black_star', 'text' => 'Eight Pointed Black Star'),
array('value' => 'eight_spoked_asterisk:','code' => 'eight_spoked_asterisk', 'text' => 'Eight Spoked Asterisk'),
array('value' => 'end:','code' => 'end', 'text' => 'End'),
array('value' => 'fast_forward:','code' => 'fast_forward', 'text' => 'Fast Forward'),
array('value' => 'five:','code' => 'five', 'text' => 'Five'),
array('value' => 'four:','code' => 'four', 'text' => 'Four'),
array('value' => 'free:','code' => 'free', 'text' => 'Free'),
array('value' => 'gemini:','code' => 'gemini', 'text' => 'Gemini'),
array('value' => 'hash:','code' => 'hash', 'text' => 'Hash'),
array('value' => 'heart_decoration:','code' => 'heart_decoration', 'text' => 'Heart Decoration'),
array('value' => 'heavy_check_mark:','code' => 'heavy_check_mark', 'text' => 'Heavy Check Mark'),
array('value' => 'heavy_division_sign:','code' => 'heavy_division_sign', 'text' => 'Heavy Division Sign'),
array('value' => 'heavy_dollar_sign:','code' => 'heavy_dollar_sign', 'text' => 'Heavy Dollar Sign'),
array('value' => 'heavy_minus_sign:','code' => 'heavy_minus_sign', 'text' => 'Heavy Minus Sign'),
array('value' => 'heavy_multiplication_x:','code' => 'heavy_multiplication_x', 'text' => 'Heavy Multiplication X'),
array('value' => 'heavy_plus_sign:','code' => 'heavy_plus_sign', 'text' => 'Heavy Plus Sign'),
array('value' => 'id:','code' => 'id', 'text' => 'Id'),
array('value' => 'ideograph_advantage:','code' => 'ideograph_advantage', 'text' => 'Ideograph Advantage'),
array('value' => 'information_source:','code' => 'information_source', 'text' => 'Information Source'),
array('value' => 'interrobang:','code' => 'interrobang', 'text' => 'Interrobang'),
array('value' => 'keycap_ten:','code' => 'keycap_ten', 'text' => 'Keycap Ten'),
array('value' => 'koko:','code' => 'koko', 'text' => 'Koko'),
array('value' => 'large_blue_circle:','code' => 'large_blue_circle', 'text' => 'Large Blue Circle'),
array('value' => 'large_blue_diamond:','code' => 'large_blue_diamond', 'text' => 'Large Blue Diamond'),
array('value' => 'large_orange_diamond:','code' => 'large_orange_diamond', 'text' => 'Large Orange Diamond'),
array('value' => 'left_luggage:','code' => 'left_luggage', 'text' => 'Left Luggage'),
array('value' => 'left_right_arrow:','code' => 'left_right_arrow', 'text' => 'Left Right Arrow'),
array('value' => 'leftwards_arrow_with_hook:','code' => 'leftwards_arrow_with_hook', 'text' => 'Leftwards Arrow With Hook'),
array('value' => 'leo:','code' => 'leo', 'text' => 'Leo'),
array('value' => 'libra:','code' => 'libra', 'text' => 'Libra'),
array('value' => 'link:','code' => 'link', 'text' => 'Link'),
array('value' => 'm:','code' => 'm', 'text' => 'M'),
array('value' => 'mens:','code' => 'mens', 'text' => 'Mens'),
array('value' => 'metro:','code' => 'metro', 'text' => 'Metro'),
array('value' => 'mobile_phone_off:','code' => 'mobile_phone_off', 'text' => 'Mobile Phone Off'),
array('value' => 'negative_squared_cross_mark:','code' => 'negative_squared_cross_mark', 'text' => 'Negative Squared Cross Mark'),
array('value' => 'new:','code' => 'new', 'text' => 'New'),
array('value' => 'ng:','code' => 'ng', 'text' => 'Ng'),
array('value' => 'nine:','code' => 'nine', 'text' => 'Nine'),
array('value' => 'no_bicycles:','code' => 'no_bicycles', 'text' => 'No Bicycles'),
array('value' => 'no_entry:','code' => 'no_entry', 'text' => 'No Entry'),
array('value' => 'no_entry_sign:','code' => 'no_entry_sign', 'text' => 'No Entry Sign'),
array('value' => 'no_mobile_phones:','code' => 'no_mobile_phones', 'text' => 'No Mobile Phones'),
array('value' => 'no_pedestrians:','code' => 'no_pedestrians', 'text' => 'No Pedestrians'),
array('value' => 'no_smoking:','code' => 'no_smoking', 'text' => 'No Smoking'),
array('value' => 'non_potable_water:','code' => 'non_potable_water', 'text' => 'Non Potable Water'),
array('value' => 'o:','code' => 'o', 'text' => 'O'),
array('value' => 'o2:','code' => 'o2', 'text' => 'O2'),
array('value' => 'ok:','code' => 'ok', 'text' => 'Ok'),
array('value' => 'on:','code' => 'on', 'text' => 'On'),
array('value' => 'one:','code' => 'one', 'text' => 'One'),
array('value' => 'ophiuchus:','code' => 'ophiuchus', 'text' => 'Ophiuchus'),
array('value' => 'parking:','code' => 'parking', 'text' => 'Parking'),
array('value' => 'part_alternation_mark:','code' => 'part_alternation_mark', 'text' => 'Part Alternation Mark'),
array('value' => 'passport_control:','code' => 'passport_control', 'text' => 'Passport Control'),
array('value' => 'pisces:','code' => 'pisces', 'text' => 'Pisces'),
array('value' => 'potable_water:','code' => 'potable_water', 'text' => 'Potable Water'),
array('value' => 'put_litter_in_its_place:','code' => 'put_litter_in_its_place', 'text' => 'Put Litter In Its Place'),
array('value' => 'radio_button:','code' => 'radio_button', 'text' => 'Radio Button'),
array('value' => 'recycle:','code' => 'recycle', 'text' => 'Recycle'),
array('value' => 'red_circle:','code' => 'red_circle', 'text' => 'Red Circle'),
array('value' => 'registered:','code' => 'registered', 'text' => 'Registered'),
array('value' => 'repeat:','code' => 'repeat', 'text' => 'Repeat'),
array('value' => 'repeat_one:','code' => 'repeat_one', 'text' => 'Repeat One'),
array('value' => 'restroom:','code' => 'restroom', 'text' => 'Restroom'),
array('value' => 'rewind:','code' => 'rewind', 'text' => 'Rewind'),
array('value' => 'sa:','code' => 'sa', 'text' => 'Sa'),
array('value' => 'sagittarius:','code' => 'sagittarius', 'text' => 'Sagittarius'),
array('value' => 'scorpius:','code' => 'scorpius', 'text' => 'Scorpius'),
array('value' => 'secret:','code' => 'secret', 'text' => 'Secret'),
array('value' => 'seven:','code' => 'seven', 'text' => 'Seven'),
array('value' => 'signal_strength:','code' => 'signal_strength', 'text' => 'Signal Strength'),
array('value' => 'six:','code' => 'six', 'text' => 'Six'),
array('value' => 'six_pointed_star:','code' => 'six_pointed_star', 'text' => 'Six Pointed Star'),
array('value' => 'small_blue_diamond:','code' => 'small_blue_diamond', 'text' => 'Small Blue Diamond'),
array('value' => 'small_orange_diamond:','code' => 'small_orange_diamond', 'text' => 'Small Orange Diamond'),
array('value' => 'small_red_triangle:','code' => 'small_red_triangle', 'text' => 'Small Red Triangle'),
array('value' => 'small_red_triangle_down:','code' => 'small_red_triangle_down', 'text' => 'Small Red Triangle Down'),
array('value' => 'soon:','code' => 'soon', 'text' => 'Soon'),
array('value' => 'sos:','code' => 'sos', 'text' => 'Sos'),
array('value' => 'symbols:','code' => 'symbols', 'text' => 'Symbols'),
array('value' => 'taurus:','code' => 'taurus', 'text' => 'Taurus'),
array('value' => 'three:','code' => 'three', 'text' => 'Three'),
array('value' => 'tm:','code' => 'tm', 'text' => 'Tm'),
array('value' => 'top:','code' => 'top', 'text' => 'Top'),
array('value' => 'trident:','code' => 'trident', 'text' => 'Trident'),
array('value' => 'twisted_rightwards_arrows:','code' => 'twisted_rightwards_arrows', 'text' => 'Twisted Rightwards Arrows'),
array('value' => 'two:','code' => 'two', 'text' => 'Two'),
array('value' => 'u5272:','code' => 'u5272', 'text' => 'U5272'),
array('value' => 'u5408:','code' => 'u5408', 'text' => 'U5408'),
array('value' => 'u55b6:','code' => 'u55b6', 'text' => 'U55b6'),
array('value' => 'u6307:','code' => 'u6307', 'text' => 'U6307'),
array('value' => 'u6708:','code' => 'u6708', 'text' => 'U6708'),
array('value' => 'u6709:','code' => 'u6709', 'text' => 'U6709'),
array('value' => 'u6e80:','code' => 'u6e80', 'text' => 'U6e80'),
array('value' => 'u7121:','code' => 'u7121', 'text' => 'U7121'),
array('value' => 'u7533:','code' => 'u7533', 'text' => 'U7533'),
array('value' => 'u7981:','code' => 'u7981', 'text' => 'U7981'),
array('value' => 'u7a7a:','code' => 'u7a7a', 'text' => 'U7a7a'),
array('value' => 'underage:','code' => 'underage', 'text' => 'Underage'),
array('value' => 'up:','code' => 'up', 'text' => 'Up'),
array('value' => 'vibration_mode:','code' => 'vibration_mode', 'text' => 'Vibration Mode'),
array('value' => 'virgo:','code' => 'virgo', 'text' => 'Virgo'),
array('value' => 'vs:','code' => 'vs', 'text' => 'Vs'),
array('value' => 'wavy_dash:','code' => 'wavy_dash', 'text' => 'Wavy Dash'),
array('value' => 'wc:','code' => 'wc', 'text' => 'Wc'),
array('value' => 'wheelchair:','code' => 'wheelchair', 'text' => 'Wheelchair'),
array('value' => 'white_check_mark:','code' => 'white_check_mark', 'text' => 'White Check Mark'),
array('value' => 'white_circle:','code' => 'white_circle', 'text' => 'White Circle'),
array('value' => 'white_flower:','code' => 'white_flower', 'text' => 'White Flower'),
array('value' => 'white_square_button:','code' => 'white_square_button', 'text' => 'White Square Button'),
array('value' => 'womens:','code' => 'womens', 'text' => 'Womens'),
array('value' => 'x:','code' => 'x', 'text' => 'X'),
array('value' => 'zero:','code' => 'zero', 'text' => 'Zero')
);

echo Response::json($emoji);
}

}