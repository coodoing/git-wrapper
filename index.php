<?php
require_once('Autoloader.php');
require_once('Configure.php');
require_once('Call.php');
require_once('CallResult.php');
require_once('Git.php');
require_once('GitRepository.php');
require_once 'File/FileWrapper.php';
require_once 'File/FileSystem.php';
require_once 'File/FileListener.php';
require_once 'File/FileWatcher.php';

echo "<br>//////////////////////////Git Repository//////////////////////////////<br>".PHP_EOL;
//echo BIN_PATH.'-'.CURRENT_WORK_REPOS.'<br>';
echo 'git repository:<br>';
$repository = new GitRepository(dirname(__FILE__));
//$repository->getGitVersion();
//$repository->getCurrentBranchCommitHashes();
//$repository->getCurrentBranch();
$repository->getResults();

echo '<br>base invoking:<br>';
$cmd = BIN_PATH.' --version'; // $BIN_PATH.' version';
$call = new Call($cmd, dirname(__FILE__));
//echo $call->getCmd().'-'.dirname(__FILE__);
$result = $call->execute();
//echo '<pre>';var_dump($result);
//echo ($result->hasStdOut());
//echo ($result->hasStdErr());
//echo ($result->getReturnCode());
echo ($result->getStdOut());
//echo '<pre>';var_dump(pathinfo(__FILE__));
echo filemtime('readme.md');
echo 'git finished';
echo "<br>///////////////////////////SHA1 and MD5/////////////////////////////<br>".PHP_EOL;
//$file = new FileSystem();
echo md5('').PHP_EOL;
echo sha1('').PHP_EOL;
echo file_exists('dg')==false;
echo PHP_EOL;

echo "<br>///////////////////////////callback method/////////////////////////////<br>".PHP_EOL;
$callback = function($name){
	echo $name.'FFFFFF';
};
#print_r($callback);
call_user_func($callback,'FFFFF').PHP_EOL;

echo "<br>///////////////////////////filelistener/////////////////////////////<br>".PHP_EOL;
$file = new FileSystem(); 
$listener = new FileListener();
//$index = new FileWrapper('index.php',$file);
//$listener->addListener($index);
//$readme = new FileWrapper('README.MD',$file);
//$listener->addListener($readme);
$wrapper = new FileWrapper(dirname(__FILE__).'\\test.txt', $file);
$listener->addListener($wrapper);
//echo '<pre>';var_dump($wrapper->checkFileStatus());
echo '<pre>';var_dump($listener->getListeners());

$listener->onCreatedEvent(function($file){
	echo "{$file}-was created".PHP_EOL;
});
$listener->onDeletedEvent(function($file){
	echo "{$file}-was deleted".PHP_EOL;
});
$listener->onChangedEvent(function($file){
	echo "{$file}-was changed".PHP_EOL;
});
$actions = $listener->getActions();
//$listener->startListen();

echo "<br>///////////////////////////filewatch default listener events/////////////////////////////<br>".PHP_EOL;
$watcher = new FileWatcher();
/*
$index = new FileWrapper('index.php',$file);
$readme = new FileWrapper('README.MD',$file);
$test = new FileWrapper('test.txt',$file);
*/
$watcher->watch('README.MD');
$watcher->watch('index.php');

// watch git HEAD
$watcher->watch('');

echo '<pre>';var_dump($watcher->getWatchList());
//$watcher->start();
//$watcher->run();
//echo '<pre>';var_dump($actions);


echo "<br>///////////////////////////filewatch given events/////////////////////////////<br>".PHP_EOL;
$watcher = new FileWatcher();
$listener1 = new FileListener();
$listener2 = new FileListener();
$listener1->onCreatedEvent(function($file){
	echo "{$file}-was created".PHP_EOL;
});
$listener1->onDeletedEvent(function($file){
	echo "{$file}-was deleted".PHP_EOL;
});
$listener1->onChangedEvent(function($file){
	echo "{$file}-was changed".PHP_EOL;
});
$watcher->bindingListener('README.MD',$listener1);
$watcher->bindingListener('index.php',$listener1);
print_r($watcher->getWatchList());

echo "<br>///////////////////////////start dameon process to run/////////////////////////////<br>".PHP_EOL;
$dameon = 'nohup php index.php > dameonlogs.log 2>&1 &';
echo $dameon;
die('');
// phpinfo();

?>