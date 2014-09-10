<?php
/**
 * getSearchRules.php
 *
 * Created by: koen
 * Date: 9/10/14
 */

include('../bootstrap.php');

$tdb = new twitterDB();

$searchRules = $tdb->getSearchBots($_POST['bot_id']);
$i = 0;
?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Rules
            </h2>
        </div>
    </div>
<?php
while($rule = $searchRules->fetchRow()): $i++;?>
    <div class="row">
        <div class="col-lg-12">
            <?php echo $rule['string']; ?>
        </div>
    </div>
<?php endwhile; ?>
<?php if($i == 0): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                Their are no rules for this bot yet.<br/><br/>
                <a href="<?php echo WEBROOT?>search/" class="btn btn-default"><i class="fa fa-search"></i> Create search rule</a>
                <a href="<?php echo WEBROOT?>location/" class="btn btn-default"><i class="fa fa-map-marker"></i> Create location rule</a>
            </div>
        </div>
    </div>
<?php endif; ?>