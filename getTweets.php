<?php

session_start();
//Require the path to the twitter oAuth library
require_once('twitteroauth/twitteroauth/twitteroauth.php');

$twitteruser = "HSC1776";
$notweets = 10;
$consumerkey = "CONSUMER_KEY";
$consumersecret = "CONSUMER_SECRET";
$accesstoken = "ACCESS_TOKEN";
$accesstokensecret = "ACCESS_SECRET";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
  
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

$i = 0;
foreach ($tweets as $tweet) {
    //echo "<pre>";
    //print_r($tweet);
    //echo "</pre>";
    echo '<img class="twitterProfileImage" src=' . $tweet->user->profile_image_url . ' alt="@HSC1776 Profile Image" />';
    echo '<a class="twitterScreenName" href="' . $tweet->user->url . '" target="_blank" title="Hampden-Sydney College">@' . $tweet->user->screen_name . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;' . $tweet->user->name;
    echo '<br /><p class="twitterTweetedFromLocation">' . $tweet->user->location . "</p>";
    echo '<p class="twitterTweetText">' . $tweet->text . '</p>';
    echo "<br /><br />";
    $i++;
}

?>