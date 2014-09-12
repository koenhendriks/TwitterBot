<?php
/**
 * getResponses.php
 *
 * Created by: koen
 * Date: 9/12/14
 */

include('../bootstrap.php');

$tdb = new twitterDB();

if($_POST['bot_id'] == 'all')
    $responses = $tdb->getResponses();
else
    $responses = $tdb->getBotResponses($_POST['bot_id']);

$i = 0;
?>
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Responses
            </h2>
        </div>
    </div>
<table class="table table-striped">
    <tr>
        <?php if($_POST['bot_id'] == 'all'): ?>
            <th>All Responses</th>
            <th>Bot</th>
        <?php else: ?>
            <th>Responses for <?php echo $tdb->getBotName($_POST['bot_id']);?></th>
        <?php endif; ?>
    </tr>
<?php
while($response = $responses->fetchRow()): $i++;?>
    <div class="row">
        <div class="col-lg-12">
            <tr>
                <td><?php echo $response['response']; ?></td>
                <?php if($_POST['bot_id'] == 'all'): ?>
                    <td><?php echo $tdb->getBotName($response['bot_id']); ?></td>
                <?php endif; ?>
            </tr>

        </div>
    </div>
<?php endwhile; ?>
</table>
<?php if($i == 0): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                Their are no responses for this bot yet.<br/><br/>
            </div>
        </div>
    </div>
<?php endif; ?>