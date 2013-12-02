<?php
/*
detail info: php manual-filesystem
*/
class FileSystem{

    public function __construct(){
        
    }

	public function lastModified($path){
		 return filemtime($path);
	}

	public function isDir($path){
		return is_dir($path);
	}

	public function isFile($path){
		return is_file($path);
	}

	public function getContent($path){
		return file_get_contents($path);
	}

	public function putContent($path, $contents){
        return file_put_contents($path, $contents);
    }

    public function fileExists($path){
    	return file_exists($path);
    }

    public function deleteFile($path){
    	// @unlink
    	if(file_exists($path))
    		unlink($path);
    }

    public function getDirName($path){
    	$info = pathinfo($path);
        return $info['dirname'];
    }

    public function getBaseName($path){
    	$info = pathinfo($path);
        return $info['basename'];
    }

    public function getExtension($path){
    	$info = pathinfo($path);
        return $info['extension'];
    }

    public function getFileName($path){
    	$info = pathinfo($path);
        return $info['filename'];
    }

    public function fileType($path){
    	return filetype($path);
    }

    public function requireOnce($path){
    	require_once $path;
    }
}
?>