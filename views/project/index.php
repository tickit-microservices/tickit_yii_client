<?php

/* @var $this yii\web\View */

$this->title = 'Tickit | Projects';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Projects</h2>

                <p>List of your projects</p>

                <?php foreach ($projects as $project) { ?>
                    <div><?php echo $project->name ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
