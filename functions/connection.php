<?php

date_default_timezone_set('America/Lima');

function connect($dbname){
	try{$db = new PDO("mysql:host=".env('dbserver').";dbname=".$dbname,env('dbuser'),env('dbpass'));
		if(env('dbserver')!="localhost") $db->query("SET TIME_ZONE = '-5:00'");
		$db->query("SET NAMES 'utf8'");return $db;
	}catch(Exception $e){echo "Failed: ".$e->getMessage();}
}$db = connect(env('dbname'));

function exe($sql){global $db;$q=$db->prepare($sql);$q->execute();return $q;}
function get($sql){$q=exe($sql);return $q->fetchAll(PDO::FETCH_ASSOC) ?: [];}
function out($data){echo json_encode($data);}

function to_attr($elem){return "`$elem`";}
function to_vlue($elem){return $elem===null ? "null" : "'$elem'";}
function insertIntoTable($table,$data){
	$attributes = implode(',',array_map('to_attr',array_keys($data)));
	$values = implode(',',array_map('to_vlue',array_values($data)));
	exe("INSERT INTO $table ($attributes) VALUES ($values)");
	return "INSERT INTO $table ($attributes) VALUES ($values)";
}
function updateTableTuple($table,$data,$column){
	$newValues = [];foreach ($data as $attribute=>$value) {
		$newValues[] = "`$attribute` = '$value'";
	}$newValues = implode(',',$newValues);
	exe("UPDATE $table SET $newValues WHERE `$column` = '{$data[$column]}'");
}
function getLastId($table,$column='id'){
	return get("SELECT $column FROM $table ORDER BY $column DESC LIMIT 0,1")[0][$column];
}

?>