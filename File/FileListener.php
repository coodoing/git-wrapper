<?php
require_once 'FileSystem.php';
require_once 'FileWrapper.php';
class FileListener{
	private $listening; // keep to listening or not
	private $fileListeners; // files to listen
	private $timeInterval = 10; // timeinterval to listen

	public function __construct(){
		$this->listening = true;
		$this->fileListeners = array();
	}

	public function addListener(FileWrapper $fileWrapper){
		$this->fileListeners[] = $fileWrapper;
	}

	public function getListeners(){
		return $this->fileListeners;
	}

	public function listen(){
		$t1 = microtime(true);
		while($this->listening){
			$t2 = microtime(true);
			if($t2-$t1>$this->timeInterval){
				echo 'stop listening';				
				//$this->listening = false;
				$this->stop();
			}else{
				echo 'keep listening';
				usleep(1000);
				$this->fileListening();
			}
		}
	}

	public function stop(){
		$this->listening = false;
	}

	protected function fileListening(){
		//echo 'KKKKK';die();
		foreach($this->fileListeners as $listener){

		}
	}

	protected function getFileEventStatus($fileWrapper){
		$status = $fileWrapper->checkFileStatus()->getEventArgs();
		switch($status){
			case FileEvent::CREATED:
				return 'created';
				break;
			case FileEvent::DELETED:
				return 'deleted';
				break;
			case FileEvent::CHANGED:
				return 'changed';
				break;
			case FileEvent::UNCHANGED:
				return 'unchanged';
				break;
		}
	}

	protected function onCreated(Closure $callback){
		// lambda function and annoymous function
		
	}
}
?>