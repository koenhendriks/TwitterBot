<?php
/**
 * nav.php
 *
 * Created by: koen
 * Date: 9/1/14
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Twitter Bot</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>
            <a href="<?php ECHO WEBROOT; ?>apps/"><i class="fa fa-th"></i> Apps </a>
        </li>
        <li>
            <a href="<?php ECHO WEBROOT; ?>config/"><i class="fa fa-gears"></i> Config </a>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="<?php echo WEBROOT; ?>"><i class="fa fa-fw fa-dashboard"></i> Status</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>