<?php
// https://github.com/coodoing/oEmbed/blob/master/autoloader/config.php
function __autoload($className){	
	//echo 'execute';
	//echo $className;
	if (file_exists($className . '.php')) { 
        require_once $className . '.php';        
    } 
    __autoload_dir();
}

function __autoload_dir($className){
	$directories = array(
		'',
		'File/',
		'Git/',
		'Logs/',
		'Test/',
		);
	foreach($directories as $directory){
        //see if the file exsists
        if(file_exists($cls = $directory.$className.'.php')){
            require_once $cls;
            return true;
        }
    }             
}
?>
