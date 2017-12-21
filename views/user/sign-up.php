<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tickit | Sign up';
?>
<div class="user-sign-up">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h3>Sign up your account</h3>

                <?php if (!empty($errorMessage)) { ?>
                    <p class="alert alert-warning"><?php echo $errorMessage ?? ''; ?></p>
                <?php } ?>

                <form method="post" class="sign-up-form">
                    <input type="text" placeholder="First name" name="first-name" value="<?php echo $userData['first-name'] ?? '' ?>"/> <br/>
                    <input type="text" placeholder="Last name" name="last-name" value="<?php echo $userData['last-name'] ?? '' ?>"/> <br/>
                    <input type="text" placeholder="Email" name="email" value="<?php echo $userData['email'] ?? '' ?>"/> <br/>
                    <input type="password" placeholder="Password" name="password" value="<?php echo $userData['password'] ?? '' ?>"/><br/>
                    <input type="password" placeholder="Retype" name="password-confirmation" value="<?php echo $userData['password-confirmation'] ?? '' ?>"/><br/>
                    <input type="submit" value="Sign up" class="btn btn-flat">
                </form>

                <p class="sign-up">Already have an account? <a href="<?php echo Url::to(['session/login-form']);?>">Login</a></p>
            </div>
        </div>
    </div>
</div>
