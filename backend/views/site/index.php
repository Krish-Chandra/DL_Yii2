<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div>

    <div class="jumbotron">
        <h1>Welcome <?php echo Yii::$app->user->identity->username ?></h1>
    </div>
</div>
