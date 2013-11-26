<?php
require_once '/predis/lib/Predis/Autoloader.php';
Predis\Autoloader::register();

global $redis;
$redis = new Predis\Client();
$redis->set('foo', 'bar');
$value = $redis->get('foo');
$server_info = $redis->info();
$db_size = $redis->dbSize();
echo __DIR__;
echo $value.$db_size."<br>";
echo json_encode($server_info);
//echo json_encode($redis->keys('*'));


################following#####################
include_once 'following.php';
// create two user nodes, assume for this example
// they're users with no social graph entries.
$user1 = new UserNode(1);
$user2 = new UserNode(2);

echo "following test:<br>";
echo json_encode($user1->following()); // array()

// add some followers
$user1->follow(2);
$user1->follow(3);

// now check the follow list
echo json_encode($user1->following()); // array(2, 3)

// now we can also do:
$user2->followed_by(); // array(1)

// if we do this...
$user2->follow(3);

// then we can do this to see which people users #1 and #2 follow in common
$user1->common_following(array(2)); // array(3)



###################user twitter################
include_once 'relationgraph.php';

$user1 = new User(1);
$user2 = new User(2);
$user3 = new User(3);

$u1cmd = new UserCommand($user1);
$u2cmd = new UserCommand($user2);

$u1cmd->follow($user2);
$u1cmd->follow($user3);

#################性能测试######################
echo "performance test:<br>";
$t1 = microtime(true);
for($i=0;$i<100000;$i++){
	$key = 'foo1'.$i;
	$value = 'bar1'.$i;
	#$redis->hset("hash",$key, $value);
	#$redis->zadd("sorted_set",$key, $value);
}
$t2 = microtime(true);
echo (($t2-$t1)*1000).'ms';

function toString(){

}

$redis = new Predis\Client(array(
    'scheme' => 'tcp',
    'host'   => '192.168.66.243',
    'port'   => 6379,
));

echo '<pre>';
var_dump($redis);
