<?php
	$binary = new Binary(BIN_PATH);
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
?>