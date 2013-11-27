<?php

function trimBrNotation(&$str){
	//1、str_replace 
	//$str = str_replace(array("/r/n", "/r", "/n"), "", $str);         
	//2、re  
	//$str = preg_replace('//s*/', '', $str);  	      
	//3、php_eol vars  
	$str = str_replace(PHP_EOL, '', $str);   
}

?>