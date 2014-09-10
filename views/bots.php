<?php
/**
 * page.php
 *
 * Created by: koen
 * Date: 9/1/14
 */

$tdb = new twitterDB();
$router = new Router();

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Bots
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <?php
            if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['app_id'])){
                $tdb->createBot($_POST['name'], $_POST['description'], $_POST['app_id']);
        ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-check"></i>  <strong>Bot added!</strong>
                        </div>
                    </div>
                </div>
        <?php
        }
            if(is_numeric($router->getValue('delete'))){
                if(is_numeric($router->getValue('confirm'))){
                    $tdb->deleteBot($router->getValue('delete'));
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-check"></i>  <strong>Bot Deleted!</strong>
                                </div>
                            </div>
                        </div>
                    <?php
                }else{
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-warning">
                                <p class="pull-right">
                                    <a href="<?php echo WEBROOT?>bots/delete/<?php echo $router->getValue('delete'); ?>/confirm/1" class="btn btn-danger"><i class="fa fa-trash-o"></i> Yes</a>
                                    <a href="<?php echo WEBROOT?>bots/" class="btn btn-default"><i class="fa fa-times"></i> No</a>
                                </p>
                                <p class="pull-left">Are you sure you want to delete this bot?</p><br/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
        ?>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" role="form" method="post">
                    <div class="form-group">
                        <label for="app_id">Twitter App:</label><br/>
                        <select class="form-control" name="app_id" id="app_id" required="required">
                            <?php
                            $apps = $tdb->getApps();
                            while($app = $apps->fetchRow()): ?>
                                <option value="<?php echo $app['id']?>"><?php echo $app['name']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div><br/><br/>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" size="60">
                    </div>
                    <button type="submit" class="btn btn-default">Create app</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Bot name</th>
                        <th>Description</th>
                        <th>Linked App</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $bots = $tdb->getBots();
                    while($bot = $bots->fetchRow()):
                        ?>
                        <tr>
                            <td><?php echo $bot['id'];?></td>
                            <td><?php echo $bot['name'];?></td>
                            <td><?php echo $bot['description'];?></td>
                            <td><a href="<?php echo WEBROOT?>apps/"><?php echo $tdb->getAppName($bot['app_id']);?></a></td>
                            <td><a href="<?php echo WEBROOT?>bots/delete/<?php echo $bot['id']?>" class="btn btn-danger"><span class="fa fa-trash-o"></span> </a></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
