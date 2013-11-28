<?php
// trim the br notation
function trimBrNotation(&$str){
	//1、str_replace 
	//$str = str_replace(array("/r/n", "/r", "/n"), "", $str);         
	//2、re  
	//$str = preg_replace('//s*/', '', $str);  	      
	//3、php_eol variable  
	$str = str_replace(PHP_EOL, '', $str);   
}

function isWin(){
	if(strpos(PHP_OS, 'WIN') !== false){
		return true;
	}
	return false;
}

// compatiable the path
function resolvePath($path){
	
}

?>