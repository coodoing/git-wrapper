<?php
/*
 * GitRepository class
 */
require_once('Util.php');
class GitRepository{
	private $repos_path;
	private $git;
	private $cmd;

	public function __construct($repos){
		$this->repos_path = $repos;
		$this->git = null;	
		$this->cmd = '';

		$this->initGitInstance();
	}

	private function getReposPath(){
		return $this->repos_path;
	}

	private function getCmd(){
		return $this->cmd;
	}

	// initialization git
	protected function initGitInstance(){
		if($this->git == null){
			$this->git = new Git(BIN_PATH);
		}
		return $this->git;
	}

	// validate the correctness of the git operation
	// 
	protected function validate(){

	}

	protected function run($command){
		$this->cmd = $this->git->createGitCommand($command);
		//echo $this->cmd.'-'.$this->repos_path;
		$call = new Call($this->cmd,$this->repos_path);
		$result = $call->execute();
		//echo '<pre>';var_dump($result);
		return $result;	// the result need to be translated to array 
	}

	public function openRepository($repos){

	}

	public function createNewRepository($repos){

	}

	// references
	public function getReferences(){

	}

	// .git/logs
	public function getReferenceHistory($ref){

	}

	// .git/refs
	public function getBranchCommit($branch){

	}

	public function getLogs(){

	}

	// branch
	public function getAllBranches(){

	}

	public function getLocalBranches(){

	}

	public function getRemoteBranches(){

	}

	public function getCurrentBranch(){
		$result = $this->run('branch');
		//echo '<pre>';var_dump($result);
		echo $result->getStdOut(); 
	}

	public function getBranchStatus($branch){

	}

	public function getCurrentBranchHashes($branch){
		return $this->readOriginHead();
	}

	public function getTags(){

	}

	public function getBlobs(){

	}

	public function getGitVersion(){
		$this->cmd = $this->git->createGitCommand('--version');
		//echo $this->cmd.'-'.$this->repos_path;
		$call = new Call($this->cmd,$this->repos_path);
		$result = $call->execute();
		//echo '<pre>';var_dump($result);
		echo $result->getStdOut();
	}


	public function gitInit(){

	}

	public function gitClone(){

	}

	// push pull
	public function gitPull(){
		//exec($GIT_PULL);
	}

	public function gitStash(){
		//exec($GIT_STASH);

	}

	public function gitPush(){
		//exec($GIT_PUSH);
	}

	public function gitCommit(){

	}

	public function gitMerge(){

	}

	public function gitDiff(){

	}

	public function gitResolveConflict(){

	}
	
	
	//////////////////////////////////////////////////////
	private function setCommitMsg($msg){

	}

	private function toString(){

	}

	//////////////////////////////////////////////////////
	protected function readOriginHead(){
		//echo ORIG_HEAD_PATH;
		$content = file_get_contents('.git/ORIG_HEAD');
		trimBrNotation(&$content);
		echo ($content);
	}

	protected function readFetchHead(){
		$handle = fopen('.git/FETCH_HEAD');

	}

	protected function readRefHead(){

	}

	protected function readLogsHead(){
		

	}



}

?>