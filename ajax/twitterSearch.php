<?php
/**
 * twitterSearch.php
 *
 * Created by: koen
 * Date: 9/4/14
 */
include('../bootstrap.php');

$tdb = new twitterDB();
$config = new twitterConfig($_POST['app_id']);

$settings = array(
    'oauth_access_token' => $config->token,
    'oauth_access_token_secret' => $config->token_secret,
    'consumer_key' => $config->API_key,
    'consumer_secret' => $config->API_secret,
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q='.$_POST['search'];
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$response = json_decode($response);
if(isset($response->statuses))
{
    if(count($response->statuses) > 0){
        $tweets = $response->statuses;
        foreach($tweets as $tweet){
            if(substr($tweet->text, 0,2) != 'RT') {
                ?>
                <div class="row from-ajax">
                    <div class="col-lg-1">
                        <b>Tweet:</b>
                    </div>
                    <div class="col-lg-1">
                        <b><?php echo $tweet->user->screen_name?></b>
                    </div>
                </div>
                <div class="row from-ajax">
                    <div class="col-lg-1">
                        <img src="<?php echo $tweet->user->profile_image_url;?>" />
                    </div>
                    <div class="col-lg-9 well">
                        <b><?php echo $tweet->text?></b>
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
