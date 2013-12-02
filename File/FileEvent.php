<?php

class FileEvent{
	const CREATED = 0;
	const DELETED = 1;
	const CHANGED = 2;
	const UNCHANGED = 3;


	private $eventArgs;	 // event args
	private $eventCode;  // event code
	private $eventFile;  // event file

	public function __construct($file,$args,$code=''){
		$this->eventFile = $file;
		$this->eventArgs = $args;
		$this->eventCode = $code;
	}

	public function getEventArgs(){
		return $this->eventArgs;
	}

	public function getEventFile(){
		return $this->eventFile;
	}

	public function getEventCode(){
		return $this->eventCode;
	}
}

?>