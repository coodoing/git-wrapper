<?php
require_once('Autoloader.php');
require_once('Configure.php');
require_once('Binary.php');
require_once('Call.php');
require_once('CallResult.php');

//Call::create(GIT_BINARY.' --version', dirname(__FILE__));
if(strpos(PHP_OS, 'WIN') !== false){
	$bin_path = WIN_GIT_BINARY;
}else{
	$bin_path = GIT_BINARY;
}

$cmd = $bin_path.' --version';
$call = new Call($cmd, dirname(__FILE__));
echo $call->getCmd();
$result = $call->execute();
echo '<pre>';var_dump($result);
echo '<br>base invoking<br>';

$binary = new Binary($bin_path);
$call   = $binary->createCall('/', '', array(
    '--version'
));
$result = $call->execute();
echo '<pre>';var_dump($result);

echo ($result->hasStdOut());
echo ($result->hasStdErr());
echo ($result->getReturnCode());
echo ($result->getStdOut());
//echo ($result->getCliCall());

/*$this->assertTrue($result->hasStdOut());
$this->assertFalse($result->hasStdErr());
$this->assertEmpty($result->getStdErr());
$this->assertEquals(0, $result->getReturnCode());
$this->assertStringStartsWith('git version', $result->getStdOut());
$this->assertSame($call, $result->getCliCall());*/
//phpinfo();
die('finished');


?>