<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tickit | Projects | ' . $project->name;
?>
<div class="project-detail">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h3><a href="<?php echo Url::to(['project/show', 'id' => $project->id]);?>">Projects: <?php echo $project->name; ?></a></h3>

                <div class="navigation">
                    <div class="navigation-item"><a class="btn btn-flat" href="<?php echo Url::to(['project/show', 'id' => $project->id, 'y' => $previousYear, 'm' => $previousMonth]);?>">Previous</a></div>
                    <div class="navigation-item current"><?php echo $month . '/' . $year;?></div>
                    <div class="navigation-item"><a class="btn btn-flat" href="<?php echo Url::to(['project/show', 'id' => $project->id, 'y' => $nextYear, 'm' => $nextMonth]);?>">Next</a></div>
                </div>

                 <table class="table table-bordered ticks">
                     <thead>
                         <tr>
                             <th>Date</th>
                             <?php foreach ($users as $user) { ?>
                                 <th style="width: <?php echo 100/(count($users) + 1);?>%;"><?php echo $user->firstName; ?></th>
                             <?php } ?>
                         </tr>
                     </thead>
                     <tbody>
                     <?php for($day = 1; $day <= $lastDay; $day++) {?>
                         <?php
                            $currentDate = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                            $isHoliday = date('N', strtotime($currentDate)) >= 6;
                         ?>
                        <tr class="<?php echo $isHoliday ? 'holiday' : '' ?>">
                            <td style="text-align: center">
                                <?php echo $currentDate . ' (' . date('D', strtotime($currentDate)) . ')';?>
                            </td>
                            <?php foreach ($users as $user) { ?>
                                <?php
                                    $ticked = !empty($tickMap[$currentDate][$user->id]);
                                    $futureDate = strtotime($currentDate) > strtotime(date('Y-m-d'));
                                ?>
                                <td class="<?php echo $ticked ? 'ticked' : ($futureDate || $isHoliday ? '' : 'not-ticked')?>"
                                    tick-id="<?php echo $ticked ? $tickMap[$currentDate][$user->id]->id : '' ?>"
                                    date="<?php echo $currentDate;?>"
                                    project-id="<?php echo $project->id?>">
                                    <?php if ($ticked) { ?>
                                        <span class="glyphicon glyphicon-ok"></span>
                                    <?php } ?>

                                    <?php if (!$ticked && !$futureDate && !$isHoliday) { ?>
                                        <span class="glyphicon glyphicon-remove"></span>
                                    <?php } ?>
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