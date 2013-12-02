<?php
require_once 'FileSystem.php';
require_once 'FileEvent.php';

// a wrapper of file system
class FileWrapper{	

	private $SHA1;	
	private $filePath;
	private $existed;
	private $atomicFile;
	
	private $fileOldName;
	private $fileNewName;	
	private $createdDate; 
	private $lastModifiedDate;

	public function __construct($path,FileSystem $file,$existed=false,$oldname='',$newname='',$createdate='',$modifieddate=''){
		$this->filePath = $path;
		$this->atomicFile = $file; // set the given file to the atomicFile		
		$this->existed = file_exists($this->filePath);
		$this->SHA1 = $this->existed?$this->getSHA1():sha1(''); 

		$this->fileOldName = $oldname;
		$this->fileNewName = $newname;
		$this->createdDate = $createdate;
		$this->lastModifiedDate = filemtime($this->filePath);

	}

	// check the file status
	public function checkFileStatus(){
		clearstatcache(true,$this->filePath); // clear cache
		// create file
		if(!$this->existed && file_exists($this->filePath)){
			$this->existed = true;
			$this->lastModifiedDate = filemtime($this->filePath);
			return new FileEvent($this,FileEvent::CREATED,'created');
		}
		// delete file
		if($this->existed && !file_exists($this->filePath)){
			$this->existed = false;
			return new FileEvent($this,FileEvent::DELETED,'deleted');
		}
		// modify file
		if($this->existed && $this->isModified()){
			$this->lastModifiedDate = filemtime($this->filePath);
			return new FileEvent($this,FileEvent::CHANGED,'changed');
		}
		//return '';
		return new FileEvent($this,FileEvent::UNCHANGED,'unchanged');
	}	

	protected function isModified(){
		return $this->lastModifiedDate < filemtime($this->filePath);
	}

	public function getSHA1(){
		$str = $this->filePath.'-'.$this->existed.'-'.$this->lastModifiedDate;
		return sha1($str);
	}

	public function getFilePath(){
		return $this->filePath;
	}

	// subject change
	public function change(){
		
	}	
}
?>