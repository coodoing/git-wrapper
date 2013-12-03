<?php
require_once 'FileListener.php';
require_once 'FileWrapper.php';
require_once 'FileSystem.php';
require_once 'Resource.php';

// file watcher
class FileWatcher{
	private $isWatching;
	private $timeInterval; // timeinterval to listen
	private $fileListeners ;
	private $fileWrappers ;
	public function __construct(){
		$this->isWatching = true;
		$this->timeInterval = 10;
		$this->fileListeners = array();//$listener;
		$this->fileWrappers = array();
	}

	// add file to the specified listener
	protected function addListener(FileWrapper $fileWrapper){
		$key = $fileWrapper->getSHA1();
		$listener = new FileListener();
		$this->fileListeners[$key] = $listener;
		$this->fileWrappers[$key] = $fileWrapper;
	}

	protected function getListeners(){
		return $this->fileListeners;
	}

	public function watch($path){
		$file = new FileSystem(); 
		$fileWrapper = new FileWrapper($path,$file);
		$this->addListener($fileWrapper);
	}

	public function getWatchList(){
		return $this->getListeners();
	}

	public function start(){
		//echo 'start';
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
				foreach($this->fileListeners as $key=>$listener){
					$listener->listening($this->fileWrappers[$key]);
				}				
			}
		}
	}

	public function run(){
		
	}

	public function stop(){
		$this->isWatching = false;
	}
}

?>