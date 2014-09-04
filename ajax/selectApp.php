<?php
/**
 * selectApp.php
 *
 * Created by: koen
 * Date: 9/4/14
 */

include('../bootstrap.php');

$config = new twitterConfig($_POST['app_id']);

header('Content-Type: application/json');
echo json_encode($config);
