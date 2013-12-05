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

	protected function registerActions($action,Closure $callback){
		//$this->actions[$file->getFilePath()][$action][] = $callback;
		$this->actions[$action] = $callback;
	}

	public function getActions(){
		return $this->actions;
	}

	public function onCreatedEvent(Closure $callback){
		// lambda function and annoymous function
		$this->registerActions('created',$callback);
	}

	public function onDeletedEvent(Closure $callback){
		// lambda function and annoymous function		
		$this->registerActions('deleted',$callback);
	}

	public function onChangedEvent(Closure $callback){
		// lambda function and annoymous function
		$this->registerActions('changed',$callback);
	}

	public function registerFileEvent($fileWrapper){
		$file = $fileWrapper->getFilePath();
		$this->onCreatedEvent(function($file){
			echo "{$file} was -created".PHP_EOL;
		});
		$this->onDeletedEvent(function($file){
			echo "{$file} was -deleted".PHP_EOL;
		});
		$this->onChangedEvent(function($file){
			echo "{$file} was-changed".PHP_EOL;
		});
	}

	public function addListener(FileWrapper $fileWrapper){
		$this->fileListeners[] = $fileWrapper;
	}

	public function getListeners(){
		return $this->fileListeners;
	}

	/////////////////////////////////////////////////////////////////////////////////////
	public function startListen(){
		$t1 = microtime(true);
		while($this->listening){
			$t2 = microtime(true);
			if($t2-$t1>$this->timeInterval){
				echo 'stop listening';				
				//$this->listening = false;
				$this->stopListen();
			}else{				
				usleep(1000000); // be cautious about the time unit
				echo 'keep listening'.PHP_EOL;
				$this->fileListening();
			}
		}
	}

	public function stopListen(){
		$this->listening = false;
	}

	protected function fileListening(){
		foreach($this->fileListeners as $listener){
			$action = $this->getFileEventAction($listener);
			echo $listener->getFilePath().'-'.$action.PHP_EOL;
			//var_dump($this->actions[$action]);
			//echo PHP_EOL;			
			if(isset($this->actions[$action])){
				//var_dump($this->actions[$listener->getFilePath()][$action]);				
				$callback = $this->actions[$action];
				//echo $action.PHP_EOL;
				//print_r($callback);
				call_user_func($callback,'test.txt');
				// array_map(function(){},$listener->getFilePath())
			}
		}
	}

	protected function getFileEventAction($file){
		$fileStatus = $file->checkFileStatus();
		if(!$fileStatus instanceof FileEvent){
			echo ''; // file_exist and unchanged
		}else{
			$action = $fileStatus->getEventArgs();
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
			}
		}
	}


	/////////////////////////////////////////////////////////////////////////////////////
	public function listening($file){
		$action = $this->getFileEventAction($file);
		echo $file->getFilePath().'-'.$action.PHP_EOL;
		//var_dump($this->actions[$action]);
		//echo PHP_EOL;			
		if(isset($this->actions[$action])){
			//var_dump($this->actions[$file->getFilePath()][$action]);				
			$callback = $this->actions[$action];
			//echo $action.PHP_EOL;
			//print_r($callback);
			call_user_func($callback,$file->getFilePath());
		}		
	}

}
?>