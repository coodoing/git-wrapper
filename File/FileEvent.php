<?php

class FileEvent{
	const CREATED = 0;
	const CHANGED = 1;
	const DELETED = 2;
	//const RENAMED = 3;

	private $fileID;
	private $parentID;
	private $eventID;
	private $SHA1;
	private $date;
	private $name;

	
}

?>