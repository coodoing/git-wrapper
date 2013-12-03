<?php
require_once 'FileListener.php';
require_once 'FileWrapper.php';

// file watcher
class FileWatcher{
	private $isWatching;
	private $timeInterval; // timeinterval to listen
	private $fileListeners ;
	public function __construct(){
		$this->isWatching = false;
		$this->timeInterval = 20;
		$this->fileListeners = array();//$listener;
	}

	public function addListener(FileWrapper $fileWrapper){
		$this->fileListeners[] = $fileWrapper;
	}

	public function getListeners(){
		return $this->fileListeners;
	}

	public function start(){
		$t1 = microtime(true);
		while($this->isWatching){
			$t2 = microtime(true);
			if($t2-$t1>$this->timeInterval){
				echo 'stop watching';				
				//$this->isWatching = false;
				$this->stop();
			}else{				
				usleep(1000000); // be cautious about the time unit
				echo 'keep watching'.PHP_EOL;
				$this->fileListener->fileListening();
			}
		}
	}

	public function stop(){
		$this->isWatching = false;
	}
}

?>