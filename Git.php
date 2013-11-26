<?php
class Git{
	private static $bin_path ;	
	
	public function __construct($bin_path = BIN_PATH){
		self::$bin_path = $bin_path;		
	}

	public function getBinPath(){
		return self::$bin_path;
	}

	private function setBinPath($bin_path){
	}

	public function createGitCommand($cmd,array $args = array()){
		if(empty($cmd))
			$cmd = escapeshellarg($cmd);
		$cmd = self::$bin_path . ' ' . $cmd;
		return $cmd;
	}

    protected static function isWindows(){
        return (strpos(PHP_OS, 'WIN') !== false);
    }    

}
?>