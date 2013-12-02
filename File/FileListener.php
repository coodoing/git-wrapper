<?php
require_once 'FileSystem.php';
require_once 'FileWrapper.php';

class FileListener{
	private $listening; // keep to listening or not
	private $fileListeners; // files to listen
	private $timeInterval = 20; // timeinterval to listen
	private $actions = array();

	public function __construct(){
		$this->listening = true;
		$this->fileListeners = array();
	}

	public function registerActions($file,$action,Closure $callback){
		$this->actions[$file->getFilePath()][$action][] = $callback;
	}

	protected function onCreated($file,Closure $callback){
		// lambda function and annoymous function
		$this->registerActions($file,'created',$callback);
	}

	protected function onDeleted($file,Closure $callback){
		// lambda function and annoymous function
		$this->registerActions($file,'deleted',$callback);
	}

	protected function onChanged($file,Closure $callback){
		// lambda function and annoymous function
		$this->registerActions($file,'changed',$callback);
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
				usleep(1000000);
				echo 'keep listening';
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
			$action = $this->getFileEventStatus($listener);
			//$this->onCreated($callback);
			if(isset($this->actions[$listener->getFilePath()][$action])){
				var_dump($this->actions[$listener->getFilePath()][$action]);die();
			}
		}
	}

	protected function getFileEventStatus($file){
		$action = $file->checkFileStatus()->getEventArgs();
		switch($action){
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

	
}
?>