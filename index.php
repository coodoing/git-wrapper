<?php
require_once('Autoloader.php');
require_once('Configure.php');
//require_once('Git/Binary.php');
require_once('Call.php');
require_once('CallResult.php');
require_once('Git.php');
require_once('GitRepository.php');

require_once 'File/FileWrapper.php';
require_once 'File/FileSystem.php';
require_once 'File/FileListener.php';

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
echo "<br>////////////////////////////////////////////////////////<br>";
//$file = new FileSystem();
echo md5('');
echo file_exists('dg')==false;

$file = new FileSystem(); 
$wrapper = new FileWrapper(dirname(__FILE__).'\\test.txt', $file);
//echo '<pre>';var_dump($wrapper->checkFileStatus());

$listener = new FileListener();
$listener->addListener(new FileWrapper('index.php',$file));
$listener->addListener(new FileWrapper('README.MD',$file));
echo '<pre>';var_dump($listener->getListeners());

$listener->listen();

die('');

?>