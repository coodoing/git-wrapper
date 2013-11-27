<?php
// https://github.com/coodoing/oEmbed/blob/master/autoloader/config.php
function __autoload($className){	
	//echo 'execute';
	//echo $className;
	if (file_exists($className . '.php')) { 
        require_once $className . '.php';        
    } 
}
?>
