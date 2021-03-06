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
		$this->timeInterval = 120;
		$this->fileListeners = array();//listener;
		$this->fileWrappers = array(); //filewrapper
	}

	// binding the filewrapper and the listener, 
	public function bindingListener($path, FileListener $listener){
		$file = new FileSystem();
		$fileWrapper = new FileWrapper($path,$file);
		$key = $fileWrapper->getSHA1();
		$this->fileListeners[$key] = $listener;
		$this->fileWrappers[$key] = $fileWrapper;
	}

	// add filewrapper to the default listener which have all listener events including create,delete and change 
	protected function addListener(FileWrapper $fileWrapper){
		$key = $fileWrapper->getSHA1();
		$listener = new FileListener();
		$listener->registerFileEvent($fileWrapper);
		$this->fileListeners[$key] = $listener;
		$this->fileWrappers[$key] = $fileWrapper;
	}

	protected function getListeners(){
		return $this->fileListeners;
	}

	protected function getFileWrappers(){
		return $this->fileWrappers;
	}

	////////////////////////////////////////////////////////////////////////////////////
	public function watch($path){
		$file = new FileSystem(); 
		$fileWrapper = new FileWrapper($path,$file);
		$this->addListener($fileWrapper);
	}

	public function getWatchList(){
		return array($this->getListeners(),$this->getFileWrappers());
	}

	public function start(){
		//echo 'start';
		$t1 = microtime(true);
		while($this->isWatching){
			$t2 = microtime(true);
			if($t2-$t1>$this->timeInterval){
				echo 'stop watching';
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