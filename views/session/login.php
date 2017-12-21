<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tickit | Login';
?>
<div class="session-login">
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

                <p class="sign-up">Don't have an account? <a href="<?php echo Url::to(['user/sign-up-form']);?>">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
