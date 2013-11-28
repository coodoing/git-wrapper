<?php
/*
 * GitRepository class
 */
require_once('Util.php');
class GitRepository{
 	const BRANCHES_ALL      = 0;
	const BRANCHES_LOCAL    = 1;
    const BRANCHES_REMOTE   = 2;
   
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

	//////////////////////////////////////////////////////////////////////////////////
	public function getGitVersion(){
		$this->cmd = $this->git->createGitCommand('--version');
		//echo $this->cmd.'-'.$this->repos_path;
		$call = new Call($this->cmd,$this->repos_path);
		$result = $call->execute();
		//echo '<pre>';var_dump($result);
		echo $result->getStdOut();
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
		return $this->run('reflog')->getStdOut();
	}

	// .git/refs
	public function getBranchCommit($branch){

	}

	public function getLogs(){
		return $this->run('log')->getStdOut();
	}

	// branch
	public function getAllBranches(){
		return $this->run('branch -a')->getStdOut();
	}

	public function getLocalBranches(){
		return $this->run('branch')->getStdOut();
	}

	public function getRemoteBranches(){
		return $this->run('branch -r')->getStdOut();
	}

	public function getCurrentBranch(){
		return $this->run('name-rev --name-only HEAD')->getStdOut();
	}

	public function getBranchStatus(){
		return $this->run('status')->getStdOut();
	}

	public function hasFileChanged(){

	}

	public function getCurrentBranchCommitHashes($branch){
		// read from ORIG_HEAD
		return $this->readOriginHead();
		// get commithashes through git cmd
		$result = $this->run('rev-parse --verify HEAD');
		echo $result->getStdOut(); 
	}

	public function getTags(){
		return $this->run('tag')->getStdOut();
	}

	public function getStashList(){
		return $this->run('stash list')->getStdOut();
	}

	///////////////////////////////////////////////////////////////////////////////////
	public function gitInit(){

	}

	public function gitClone(){

	}

	public function gitAdd(){

	}

	public function gitAddTag($tag,$message=''){
		return $this->run("tag -a $tag -m $message");
	}	

	// push pull
	public function gitPull(){
		return $this->run('pull')->getStdOut();
	}

	public function gitStash(){
		return $this->run('stash')->getStdOut();
	}

	public function gitPush($remote,$branch){
		return $this->run("push --tags $remote $branch");
	}

	public function gitCheckout($branch){
		return $this->run("checkout $branch");
	}

	public function gitCreateBranch($branch){
		return $this->run("branch $branch");
	}

	public function gitCheckoutTracking($remote){
		return $this->run("checkout -t $remote");
	}	

	public function gitDeleteBranch($branch){
		return $this->run("branch -D $branch");
	}

	public function gitCommit($message=''){
		return $this->run("commit -av -m ".escapeshellarg($message))->getStdOut();		
	}

	// merge current branch with $branch
	public function gitMerge($branch){

	}

	// fetch from remote branch
	public function gitFetch(){
		return $this->run('fetch')->getStdOut();
	}

	public function gitDiff(){

	}

	public function gitResolveConflict(){

	}

	public function getResults(){	
		echo "<br>";	
		echo "PHP Branch: ".$this->getCurrentBranch()."<br>";
		echo "PHP SHA-1 Hash: ".$this->getCurrentBranchCommitHashes()."<br>";
		echo "Repository Path: ".$this->repos_path."<br>";
		echo "Git version: ".$this->getGitVersion()."<br>";
	}

	///////////////////////////////////////////////////////////////////////////////////
	protected function readOriginHead(){
		//echo ORIG_HEAD_PATH;
		$content = file_get_contents('.git/ORIG_HEAD');
		trimBrNotation($content);
		echo ($content);
	}

	protected function readFetchHead(){
		$fp = fopen('.git/FETCH_HEAD','r');
		fwrite($fp,$content);
		fclose($fp);
	}

	protected function readRefHead(){

	}

	protected function readLogsHead(){
		
	}	
}

?>