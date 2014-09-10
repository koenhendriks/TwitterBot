<?php
/**
 * location.php
 *
 * Created by: koen
 * Date: 9/5/14
 */

$tdb = new twitterDB();
?>
<div class="container-fluid" id="ajax-search-output">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Location Search
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="app_id">Twitter App:</label>
                <select class="form-control" name="app_id" id="app_id" required="required" onchange="ajaxSelect(this, 'selectApp.php', {app_id: $(this).val()});">
                    <?php
                    $apps = $tdb->getApps();
                    while($app = $apps->fetchRow()): ?>
                        <option value="<?php echo $app['id']?>"><?php echo $app['name']?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <div id="gmaps" style="height: 400px;"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Results
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="progress" style="display:none;" id="search-progress">
                <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
</div>
