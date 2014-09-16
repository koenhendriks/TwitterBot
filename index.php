<?php
/**
 * index.php
 *
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 8/25/14
 * @copyright 2014 Koen Hendriks
 */

include('bootstrap.php');

$router = new Router;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Twitter Bot</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo WEBROOT?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo WEBROOT?>css/sb-admin.css" rel="stylesheet">

    <!-- Custom Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body base="<?php echo WEBROOT?>" id="body">
    <div id="wrapper">
        <?php
            include(ROOT.'views/nav.php');
        ?>

        <div id="page-wrapper">
            <?php
                if($router->getPage() != "")
                {
                    if(file_exists(ROOT.'views/'.$router->getPage().'.php'))
                        include(ROOT.'views/'.$router->getPage().'.php');
                    else
                        include(ROOT.'views/404.php');
                }else{
                    include(ROOT.'views/bots.php');
                }
            ?>
        </div>
        <!-- Page Wrapper -->
    </div>

<!-- Scripts -->
<script src="<?php echo WEBROOT?>js/config.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo WEBROOT;?>js/maps.js"></script>
<script src="<?php echo WEBROOT?>js/jquery-1.11.0.js"></script>
<script src="<?php echo WEBROOT?>js/ajax.js"></script>
<script src="<?php echo WEBROOT?>js/tabs.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo WEBROOT?>js/bootstrap.min.js"></script>

<script type="text/javascript">
    if($('#gmaps').length > 0)
        google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>