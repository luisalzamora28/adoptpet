<?php

# HELPERs HELPERS
function _domain () {
    return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
}
function _subdir () {
    $limit_subdir = strpos(strtolower($_SERVER['PHP_SELF']), 'index.php');
    return substr(strtolower($_SERVER['PHP_SELF']), 0, $limit_subdir);
}

# ROUTE HELPERS
function url ($uri) {
    return _domain() . _subdir() . $uri;
}
function current_route () {
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $limit_subdir = strlen(_subdir());
    return substr($path, $limit_subdir);
}
function asset ($file_path) {
    return url('assets/'.$file_path);
}
function redirect ($uri) {
    header("Location: " . url($uri));exit();
}

# VIEW HELPERS
function view($path, $data = []){
    $GLOBALS['view_variables'] = [];
	array_map(function ($i, $v) {$GLOBALS['view_variables'][$i] = $v;}, array_keys($data), $data);
    extract((array)@$GLOBALS['view_variables']);
	include("views/$path.php");
}
function create($id, $function){
    return $GLOBALS['place'][$id] = $function;
}
function place($str){
    return (@$GLOBALS['place'][$str] ?: function(){})();
}

?>