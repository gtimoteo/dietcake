<?php

function validate_between($check, $min, $max){
	$n = mb_strlen($check);
	return $min <= $n && $n <= $max;
}

function check_session(){
	if (!isset($_SESSION['username'])){
        header("Location: /thread/index");
        die();
	}
}
?>