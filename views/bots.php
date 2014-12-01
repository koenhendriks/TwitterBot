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

    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Bots
                </h1>
                <p>Here you can manage and add your Twitter bots. A Twitter bot needs to be linked to an existing Twitter app with a working API.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Add bot
                </h2>
                <p>Choose your Twitter app and add a name and desription to create a new bot.</p>
            </div>
        </div>

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
        <?php } ?>
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
                    <button type="submit" class="btn btn-default">Create bot</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Manage bots
                </h2>
            </div>
        </div>

        <?php
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#bots" role="tab" data-toggle="tab">Bots</a></li>
                    <li><a href="#rules" role="tab" data-toggle="tab">Rules</a></li>
                    <li><a href="#responses" role="tab" data-toggle="tab">Responses</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade in active" id="bots">
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>This are all the created bots.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
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

                    <div class="tab-pane fade" id="rules">
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Choose a bot and manage the rules that apply for a bot.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $bots = $tdb->getBots(); ?>
                                <div class="form-group">
                                    <label for="app_id">Twitter Bot:</label><br/>
                                    <select class="form-control" name="app_id" id="app_id" required="required" onchange="getBotRules($(this).val());">
                                        <option value="" disabled>Choose a bot</option>
                                        <?php while($bot = $bots->fetchRow()): ?>
                                                <option value="<?php echo $bot['id']?>"><?php echo $bot['name']?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="from-ajax" id="bot-rules"></div>


                    </div>

                    <div class="tab-pane fade" id="responses">
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>This are the responses for your bot</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $bots = $tdb->getBots(); ?>
                                <div class="form-group">
                                    <label for="app_id">Twitter Bot:</label><br/>
                                    <select class="form-control" name="app_id" id="app_id" required="required" onchange="getBotResponses($(this).val());">
                                        <option value="all">All bots</option>
                                        <?php while($bot = $bots->fetchRow()): ?>
                                            <option value="<?php echo $bot['id']?>"><?php echo $bot['name']?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="from-ajax" id="ajax-responses">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>
                                        Responses
                                    </h2>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <tr>
                                    <th>All Responses</th>
                                    <th>Bot</th>
                                </tr>
                                <?php $responses = $tdb->getResponses(); ?>
                                <?php while($response = $responses->fetchRow()): ?>
                                    <tr>
                                        <td><?php echo $response['response']; ?></td>
                                        <td><?php echo $tdb->getBotName($response['bot_id']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>


                    </div>

                </div>

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
