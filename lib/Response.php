<?php 

class Response {

// Json
public static function json($data = array(), $status = 200, array $headers = null, $options = 0){

http_response_code($status);

$header = isset($headers) ? $headers : 'Content-type: application/json; charset=utf-8';

header($header);

echo json_encode($data, $options);

exit;
}

// Xml
public static function xml($data = array(), $status = 200){

http_response_code($status);

$header = 'Content-type: application/xml; charset=utf-8';

header($header);

return $data;
}

// Xml
public static function rss($data = array(), $status = 200){

http_response_code($status);

$header = 'Content-type: text/xml; charset=utf-8';

header($header);

return $data;
}

	
}