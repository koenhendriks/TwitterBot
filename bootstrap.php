<?php
/**
 * bootstrap.php
 *
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 8/25/14
 * @copyright 2014 Koen Hendriks
 */

// Development environment settings
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

//Setting dedicated directory locations
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/TwitterBot/");
define("WEBROOT", "http://".$_SERVER['HTTP_HOST']."/TwitterBot/");

//Configure debug bar
$debug_array = array();
$included = array();

/**
 * Function to recursively scan a folder and include .php files
 *
 * @param $dir
 * @return array
 */
function dirToArray($dir) {

    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            }
            else
            {
                $extension = substr($value, -3);
                if($extension == 'php')
                {
                    include($dir.DIRECTORY_SEPARATOR.$value);
                    $result[] = $value;

                    //debug
                    if(!isset($included) || !is_array($included))
                        $included = array();
                    else
                        array_push($included, $value);
                }
            }
        }
    }
    return $result;
}

// Run the bootstrap and add debugging
dirToArray(ROOT.'/inc');
