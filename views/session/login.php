<?php

/* @var $this yii\web\View */

$this->title = 'Tickit | Login';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Login</h2>

                <p><?php echo $errorMessage ?? ''; ?></p>

                <form method="post">
                    <input type="text" placeholder="Email" name="email" /> <br/>
                    <input type="password" placeholder="Password" name="password" /><br/>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>
