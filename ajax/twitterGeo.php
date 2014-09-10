<?php
/**
 * twitterGeo.php
 *
 * Created by: koen
 * Date: 9/5/14
 */
include('../bootstrap.php');

$tdb = new twitterDB();
$config = new twitterConfig(5);

$settings = array(
    'oauth_access_token' => $config->token,
    'oauth_access_token_secret' => $config->token_secret,
    'consumer_key' => $config->API_key,
    'consumer_secret' => $config->API_secret,
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getField = '?geocode='.$_POST['lat'].','.$_POST['lng'].',1mi&count=100";';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getField)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$response = json_decode($response);
if(isset($response->statuses))
{
    if(count($response->statuses) > 0){
        $tweets = $response->statuses;
        foreach($tweets as $tweet){
            if(substr($tweet->text, 0,2) != 'RT') {
                $date = date('H:i d-m-Y', strtotime($tweet->created_at));
                ?>
                <div class="tweet" data-screen-name="<?php echo $tweet->user->screen_name?>" data-tweet="<?php echo $tweet->text?>" data-location="<?php echo $tweet->geo->coordinates[0]; ?>,<?php echo $tweet->geo->coordinates[1]; ?>" data-user-image="<?php echo $tweet->user->profile_image_url; ?>">
                    <div class="row from-ajax">
                        <div class="col-lg-1">
                            <b>Tweet:</b>
                        </div>
                        <div class="col-lg-11">
                            <b><a href="http://twitter.com/<?php echo $tweet->user->screen_name?>"><?php echo $tweet->user->screen_name ?></a></b> - <small><?php echo $date ?></small>
                        </div>
                    </div>
                    <div class="row from-ajax">
                        <div class="col-lg-1">
                            <a href="http://twitter.com/<?php echo $tweet->user->screen_name?>">
                                <img src="<?php echo $tweet->user->profile_image_url;?>" class="user-image" />
                            </a>
                        </div>
                        <div class="col-lg-9 well">
                            <b><?php echo $tweet->text?></b>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
    }
}else{
    ?>
    <div class="row from-ajax">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-times"></i>  <strong>No results</strong>
            </div>
    <?php
}
