<?php

// use redis sorted_set
class UserCommand{
	private $user;
	private $redis;

	public function __construct($user){		
		$this->user = $user;//new User($id);
		if(!$this->redis){
			global $redis;
			$this->redis = $redis;
		}else{
			$this->redis = new Predis\Client(); // use the local redis server
		}
	} 

	public function follow($user){
		$this->redis->sadd("relationgraph:userinfo:{$this->user->getUserID()}:following", $user->getUserID());
		$this->redis->sadd("relationgraph:userinfo:{$user->getUserID()}:followed_by", $this->user->getUserID());
	}

	public function unFollow($user_id){

	}

	public function isFollowing($user_id){
		$this->redis->sismember("");
	}

	public function isFollowedBy($user_id){
		$this->redis->sismember("");
	}

	public function getFollowingList($user_id){
		return $this->redis->smembers("");
	}

	public function getFollowedByList($user_id){
		return $this->redis->smembers("");
	}

	public function getFollowingCount(){
		return $this->redis->scard("");
	}

	public function getFollowedByCount(){
		return $this->redis->scard("");
	}

	public function getCommonFollowing(){

	}

	public function getCommonFollowedBy(){

	}
}

class User{
	private $user_id;

	public function __construct($userid){
		$this->user_id = $userid;
	}

	public function getUserID(){
		return $this->user_id;
	}
}

?>