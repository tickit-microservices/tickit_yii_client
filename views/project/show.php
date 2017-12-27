<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tickit | Projects | ' . $project->name;
?>
<div class="project-detail">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h3>Projects: <?php echo $project->name; ?></h3>

                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Date</th>
                             <?php foreach ($users as $user) { ?>
                                 <th><?php echo $user->firstName; ?></th>
                             <?php } ?>
                         </tr>
                     </thead>
                     <tbody>
                     <?php for($i = 1; $i <= 31; $i++) {?>
                        <tr>
                            <td>
                                <?php
                                $currentDate = $year . '-' . $month . '-' . $i;
                                echo $currentDate;
                                ?>
                            </td>
                            <?php foreach ($users as $user) { ?>
                                <?php
                                $ticked = !empty($tickMap[$currentDate][$user->id]);
                                ?>
                                <td class="<?php echo $ticked ? 'ticked' : ''?>">
                                    <?php echo $ticked ? 'Yes' : 'No';?>
                                </td>
                            <?php } ?>
                        </tr>
                     <?php } ?>
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
</div>
