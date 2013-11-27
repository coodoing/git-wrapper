<?php
/*
 * configuration 
 */
///////////////////////GIT CONFIGURE//////////////////////////
define('GIT_BINARY','/usr/local/bin/git');
define('GIT_BINARY_WIN','/bin/git');
define('GIT_REPOSITORY_PATH','/var/www/vhosts');
define('GIT_REPOSITORY_PATH_WIN','D:\\project\\git');
define('CURRENT_WORK_REPOS','D:\\Work\\php\\git-wrapper');
define('CURRENT_WORK_REPOS','D:\\project\\test\\git-wrapper');
if(strpos(PHP_OS, 'WIN') !== false){
	//$BIN_PATH = GIT_BINARY_WIN;
	//$REPOSITORY_PATH = GIT_REPOSITORY_PATH_WIN;
	define('BIN_PATH',GIT_BINARY_WIN);
	define('REPOSITORY_PATH',GIT_REPOSITORY_PATH_WIN);
}else{
	//$BIN_PATH = GIT_BINARY;
	//$REPOSITORY_PATH = REPOSITORY_PATH;
	define('BIN_PATH',GIT_BINARY);
	define('REPOSITORY_PATH',GIT_REPOSITORY_PATH);
}

///////////////////////PATH CONFIGURE//////////////////////////
$GIT_PATHES = array();
define('DIR_GIT','.git');
define('GIT_PATH',REPOSITORY_PATH.'/'.DIR_GIT);
define('ORIG_HEAD_PATH',GIT_PATH.'/'.'ORIG_HEAD');
define('FETCH_HEAD_PATH',GIT_PATH.'/'.'FETCH_HEAD');
define('REF_HEAD_PATH',GIT_PATH.'/'.'HEAD');

//echo REF_HEAD_PATH.'<br>';
?>