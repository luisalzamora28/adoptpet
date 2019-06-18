<?php

define('INTR',include("settings/interface.php"));
define('ENVR',include("settings/environment.php"));
define('THEME','light');

# SETTINGS HELPER
function int($obj,$mode){return @INTR['interfaces'][$mode][$obj] ?: @INTR['interfaces'][@INTR['default']][$obj];}
function env($obj){return @ENVR['environments'][@ENVR['current']][$obj];}

# ROUTE HELPERS
function route($str,$mode){return @(env('domain').@int('htname',$mode)."{$str}");}
function asset($str){return env('domain')."assets/$str";}
function json($str){return json_decode(file_get_contents(asset('docs/'.$str)),true);}
function redirect($str){header("Location: $str");exit();}

# VIEW HELPERS
function view($str,$data=[]){$GLOBALS['view_variables']=[];
	array_map(function($i,$v){$GLOBALS['view_variables'][$i]=$v;},array_keys($data),$data);
    extract((array)@$GLOBALS['layout_variables']);extract((array)@$GLOBALS['view_variables']);
	$page=@include("settings/view.php");$page=@$page[$str];include("views/$str.php");
}
function create($str,$fun){return $GLOBALS['place'][$str] = $fun;}
function place($str){return (@$GLOBALS['place'][$str]?:function(){})();}

# OTHER HELPERS
function capitalize($str){return strtoupper($str[0]).substr($str,1);}
function css_vars($vars){$temp=[];foreach($vars as $var=>$val){$temp[]= $var.':'.$val;}return implode(';',$temp);}
function text2html($text){
    $str="";for($i=0,$j=0;$i<strlen($text);$i++){
        $str.=($text[$i]=='*'&&!(@$text[$i-1]=="*"&&@$text[$i+1]=="*"))?((++$j)%2==1?"<strong>":"</strong>"):$text[$i];
    }return '<p>'.$str.'</p>';
}

?>