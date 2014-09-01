<?php
/**
 * config.php
 *
 * Created by: koen
 * Date: 9/1/14
 */
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Config
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <?php
        if(isset($_POST['API_key']) && isset($_POST['API_secret'])){
            $twitterDB = new twitterDB();
            $twitterDB->saveConfig($_POST);
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check"></i>  <strong>Config saved!</strong>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <div class="row">
            <div class="col-lg-12">
                <div class="bs-example">
                    <form method="post">
                        <div class="form-group">
                            <label for="API_key">API Key</label>
                            <input type="text" class="form-control" name="API_key" id="API_key" placeholder="ex: wdzGSawhXKV1lGsdWq0Xa5w8q">
                        </div>
                        <div class="form-group">
                            <label for="API_secret">API Secret</label>
                            <input type="text" class="form-control" name="API_secret" id="API_secret" placeholder="ex: IgEuVjCy4rgKJxIaW1ktvFnI4cSbNwcwkc3p7gOX5VRUnbSUgb">
                        </div>
                        <div class="form-group">
                            <label for="owner">Owner</label>
                            <input type="text" class="form-control" name="owner" id="owner" placeholder="ex: twitter">
                        </div>
                        <div class="form-group">
                            <label for="ownerID">Owner ID</label>
                            <input type="text" class="form-control" name="ownerID" id="ownerID" placeholder="ex: 2738439346">
                        </div>

                        <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Save</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
