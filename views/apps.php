<?php
/**
 * apps.php
 *
 * Created by: koen
 * Date: 9/4/14
 */


$tdb = new twitterDB();
$router = new Router();


?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Apps
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <?php
    if(isset($_POST['name']) && isset($_POST['description'])){
        $tdb->createApp($_POST['name'], $_POST['description']);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check"></i>  <strong>Application added!</strong>
                </div>
            </div>
        </div>
    <?php
    }

    if(is_numeric($router->getValue('delete'))){
        $tdb->deleteApp($router->getValue('delete'));
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check"></i>  <strong>Application Deleted!</strong>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-lg-12">
            <form class="form-inline" role="form" method="post">
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
                        <th>App name</th>
                        <th>Description</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $apps = $tdb->getApps();
                        while($app = $apps->fetchRow()):
                    ?>
                        <tr>
                            <td><?php echo $app['id'];?></td>
                            <td><?php echo $app['name'];?></td>
                            <td><?php echo $app['description'];?></td>
                            <td><a href="<?php echo WEBROOT?>apps/delete/<?php echo $app['id']?>" class="btn btn-danger"><span class="fa fa-trash-o"></span> </a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
