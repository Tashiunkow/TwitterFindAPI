<?php
require_once('OAuth.php');
require_once('TwitterAPIExchange.php');
require_once('twitteroauth.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
error_reporting(0);
ini_set('display_errors', 0);
$settings = array(
'oauth_access_token' => "33093650-lMlbx8bcuRLVkj5pMEiq8DBJowq2k3M8gDm7JdHKX",
'oauth_access_token_secret' => "ZsFfmHcZBMVSmS1r8lB5F1YVhbIKRNRmWiwECN8ars",
'consumer_key' => "5sk7dKsZGWfSycMZhRN8F93SW",
'consumer_secret' => "CIKf9lN29zhnw6U6dc0GWtiWaaBYSwmBrcgHpUtCdqabRoAqql"
);

$requestMethod = "GET";

$url = "https://api.twitter.com/1.1/search/tweets.json";

$key = $_GET["search"];
$getfield = "?q=".$key."&result_type=popular&count=10";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);

?>
<html>
	<head>
	</head>
		<body>
			<table>
			<tr>
				<th>Twitter ID</th>
				<th>Tweet</th>
				<th>Date and Time</th>
				<th>Profile Pic</th>
			</tr>
	
<?php for ($i=0; $i<10; $i++) {
	$twitter_id = 'Twitter ID: '.$string['statuses'][$i]['user']['id_str'];
	$text = 'Tweet: '.$string['statuses'][$i]['text'];
	$time = 'Time: '.$string['statuses'][$i]['created_at']; 
	$profile_pic = '<img src='.$string['statuses'][$i]['user']['profile_image_url'].'></img>';
	
	
	?>
<tr>
	<td><?php echo$twitter_id; ?></td>
	<td><?php echo$text; ?></td>
	<td><?php echo$time; ?></td>
	<td><?php echo$profile_pic; ?></td>
</tr>
<?php }?>
			</table>

<form name='searchsomething'>
	<label>Search Keyword</label>
	<input type='text' name='search'/>
	<input type='submit'>
</form>
		</body>

</html>