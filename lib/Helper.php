<?php
class Helper extends Prefab {

/* Limit Desc */
function crop($string,$length,$dots = "...") {
return (strlen($string) > $length) ? mb_strcut($string, 0, $length - strlen($dots)) . $dots : $string;
}

/* Strip Tags */
function striptags($val){
return strip_tags($val);
}

/* Strip Slashes */
function remove_slash($val){
return stripslashes($val);
}

/* Remove WhiteSpaces */
function remove_spaces($string){
return trim($string);
}

/* Covert Spaces to minus */
function remove_white_spaces($string){
return preg_replace("/\W+/isu","-",$string);
}

/* Replace Hashtag, Mentions, Emoji */
function replace_data($string){
$home_url = Base::instance()->get("home_url");

$patterns = array(
"/:(.*?):/i", //Emoji
"/@(\w+)/", // Mentions
"/#(\w+)/", // Hashtag
"/(\s|>|^)(https?:[^\s<]*)/i" // oEmbed
);

$replacements = array(
"<i class=\"twa twa-lg twa_$1\" title=\"$0\"></i>", //Emoji
"<a href=\"$home_url/$1\">@$1</a>",
"<a href=\"$home_url/hashtag/$1\">#$1</a>",
'$1<a href="$2" id="embed" class="embed-responsive embed-responsive-16by9">$2</a>');

return preg_replace($patterns,$replacements,$string);
}

}