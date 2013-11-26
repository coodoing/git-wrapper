<?php
// repository path
$_repo = 'D:/project/git/vela.website/';
$_git = '.git/';
$_git_logs = $_git.'logs/';
$GIT_PATH = $_repo.$_git;
$HEAD_PATH = $_repo.$_git_logs.'HEAD';
$ORIG_HEAD_PATH = $_repo.$_git.'ORIG_HEAD';
$FETCH_HEAD_PATH = $_repo.$_git.'FETCH_HEAD';
$REF_HEAD_PATH = $_repo.$_git.'HEAD';

//https://github.com/patrikf/glip/blob/master/lib/git.class.php
/*const OBJ_NONE = 0;
const OBJ_COMMIT = 1;
const OBJ_TREE = 2;
const OBJ_BLOB = 3;
const OBJ_TAG = 4;
const OBJ_OFS_DELTA = 6;
const OBJ_REF_DELTA = 7;*/
// git command
$GIT_PUSH = 'git push';
$GIT_PULL= 'git pull';
$GIT_STASH = 'git stash';
$GIT_STATUS = 'git status';
$GIT_CHECKOUT = 'git checkout';
$GIT_MERGE = 'git merge';
$GIT_BRANCH_LOCAL = 'git branch';
$GIT_BRANCH_LOCAL_BIAS = 'git br';
$GIT_BRANCH_LOCAL_DETAIL = 'git branch -v';
$GIT_BRANCH_ALL = 'git branch -a';
$GIT_BRANCH_REMOTE = 'git branch -r';
$message = 'push message';


shell_exec('ls /d');
system('ls /d');
passthru('ls /d');
//exec('start C:\Windows\System32\calc.exe');
//exec('"C:\Program Files (x86)\Git\bin\sh.exe" --login -i');
//exec('start "C:\Program Files (x86)\Git\bin\sh.exe --login -i"');
//system("ping 127.0.0.1");
shell_exec('java -version');
exec('java -version');
system('java -version');
getCurrentGitBranch($GIT_BRANCH_LOCAL);
getCurrentHashValue();



// ########################################
/*require_once('Git.php');
$repo = Git::open('D:/project/git/vela.website');  // -or- Git::create('/path/to/repo')
$repo->add('.');
$repo->commit('Some commit message');
$repo->push('origin', 'master');*/

// ########################################
// we need to lock the git file when handle the git file
// handle git 
function handleGit($path){
	$result = gitPull();
	if($result == 'aborting'){
		gitStash();
		gitPull();
	}

	getCurrentGitBranch();
	getCurrentHashValue();
}

function gitPull(){
	exec($GIT_PULL);
}

function gitStash(){
	exec($GIT_STASH);
}

function gitPush(){
	exec($GIT_PUSH);
}

function getBranchStatus(){

}

// get current branch
function getCurrentGitBranch($GIT_BRANCH_LOCAL){
	echo $GIT_BRANCH_LOCAL;
	$cur_br = shell_exec($GIT_BRANCH_LOCAL);
	echo $cur_br;
}

// get current hash
function getCurrentHashValue(){

}

// handle HEAD file
function handleHead($path){

}

?>