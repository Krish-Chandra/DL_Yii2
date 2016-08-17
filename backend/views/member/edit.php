<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Edit Member";
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div style="width: 700px;">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <b>Edit Member User</b>
        </div>
        <div class="panel-body">
            <?php
            echo Html::activeLabel($model, 'username');
            echo '<br />';
            echo $model->username;

            $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No'])->label('Active?') ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Cancel', ['member/index'], ['class' => 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

</div>



