<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tickit | Projects';
?>
<div class="project-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <h3>Projects</h3>

                <div class="projects">
                <?php
                foreach ($allProjects as $project) {
                    $userHasJoinedThisProject = isset($projectUserMap[$project->id]) && $projectUserMap[$project->id];
                ?>
                    <div class="project-detail">
                        <div class="project-name">
                            <?php echo $project->name ?>
                        </div>

                        <?php if ($userHasJoinedThisProject) { ?>
                        <a class="btn btn-flat" href="<?php echo Url::to(['project/show', 'id' => $project->id]);?>">GO TO</a>
                        <?php } else { ?>
                            <form method="post" action="<?php echo Url::to(['project/join', 'id' => $project->id]); ?>">
                                <button type="submit" class="btn btn-flat btn-secondary">JOIN</button>
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
