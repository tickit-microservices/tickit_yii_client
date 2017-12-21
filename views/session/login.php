<?php

/* @var $this yii\web\View */

$this->title = 'Tickit | Login';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h3>Login to your account</h3>

                <?php if (!empty($errorMessage)) { ?>
                    <p class="alert alert-warning"><?php echo $errorMessage ?? ''; ?></p>
                <?php } ?>

                <form method="post" class="login-form">
                    <input type="text" placeholder="Email" name="email"/> <br/>
                    <input type="password" placeholder="Password" name="password"/><br/>
                    <input type="submit" value="Login" class="btn btn-flat">
                </form>
            </div>
        </div>
    </div>
</div>
