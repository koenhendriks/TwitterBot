<?php
/**
 * twitterDB.php
 *
 * Created by: koen
 * Date: 9/1/14
 */

class twitterDB {


    public function saveConfig($config)
    {
        $db = new Database();
        $db->query("TRUNCATE `twitter_config`");
        $db->query("INSERT INTO `twitter_config` VALUES ('".$db->DataCheck($config['API_key'])."','".$db->DataCheck($config['API_secret'])."','".$db->DataCheck($config['owner'])."','".$db->DataCheck($config['ownerID'])."')");
    }

} 