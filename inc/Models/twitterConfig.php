<?php
/**
 * twitterConfig.php
 *
 * Created by: koen
 * Date: 9/4/14
 */

class twitterConfig {

    public $API_key;
    public $API_secret;
    public $owner;
    public $ownerID;
    public $token;
    public $token_secret;

    public function __construct($app_id){
        $tdb = new twitterDB();
        $config = $tdb->getConfig($app_id);
        foreach($config as $key => $value){
            $this->$key = $value;
        }
    }
}