<?php
/**
 * twitterDB.php
 *
 * Created by: koen
 * Date: 9/1/14
 */

class twitterDB {

    /**
     * Save new configs into the database
     *
     * @param $config
     */
    public function saveConfig($config)
    {
        $db = new Database();
        if($db->exists('twitter_apps', 'id='.$config['app_id']))
        {
            if($db->exists('twitter_config', 'app_id='.$config['app_id'])) {
                $db->query("UPDATE `twitter_config` SET `API_key` = '".$db->DataCheck($config['API_key'])."', `API_secret` = '".$db->DataCheck($config['API_secret'])."', `owner` = '".$db->DataCheck($config['owner'])."', `ownerID` = '".$db->DataCheck($config['ownerID'])."', `token` = '".$db->DataCheck($config['token'])."', `token_secret` = '".$db->DataCheck($config['token_secret'])."'");
            }
            else{
                $db->query("INSERT INTO `twitter_config` VALUES (NULL,'".$db->DataCheck($config['app_id'])."','".$db->DataCheck($config['API_key'])."','".$db->DataCheck($config['API_secret'])."','".$db->DataCheck($config['owner'])."','".$db->DataCheck($config['ownerID'])."')");
            }
        }else{
            utils::error('Twitter App Error!', 'Given app doesn\'t exists');
        }
    }

    /**
     * Get config from an App
     *
     * @param $app_id
     * @return array
     */
    public function getConfig($app_id)
    {
        $db = new Database();
        return $db->getRow("SELECT `API_key`,`API_secret`, `owner`, `ownerID`,`token`,`token_secret` FROM `twitter_config` WHERE `app_id` = '".$db->DataCheck($app_id)."'");
    }

    /**
     * Get all created apps
     * @return result
     */
    public function getApps(){
        $db = new Database();
        return $db->query("SELECT * FROM `twitter_apps`");
    }

    public function createApp($name, $description)
    {
        $db = new Database();
        return $db->query("INSERT INTO `twitter_apps` VALUES (NULL, '".$db->DataCheck($name)."', '".$db->DataCheck($description)."')");
    }

    public function deleteApp($app_id)
    {
        $db = new Database();
        $db->query("DELETE FROM `twitter_config` WHERE `app_id` = '".$db->DataCheck($app_id)."'");
        $db->query("DELETE FROM `twitter_apps`  WHERE `id` = '".$db->DataCheck($app_id)."'");
    }

} 