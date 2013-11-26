<?php
require_once('Autoloader.php');
require_once('Configure.php');
require_once('Git/Binary.php');
require_once('Call.php');
require_once('CallResult.php');
require_once('Git.php');
require_once('GitRepository.php');

echo BIN_PATH.'-'.CURRENT_WORK_REPOS.'<br>';
$repository = new GitRepository(CURRENT_WORK_REPOS);
$repository->getGitVersion();
echo 'git repository<br>';

$cmd = BIN_PATH.' --version'; // $BIN_PATH.' version';
$call = new Call($cmd, dirname(__FILE__));
echo $call->getCmd().'-'.dirname(__FILE__);
$result = $call->execute();
echo '<pre>';var_dump($result);
echo '<br>base invoking<br>';

//phpinfo();
die('finished');

?>