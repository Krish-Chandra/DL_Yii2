<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Publisher */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="author-form" style="width:500px">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'publishername')->textInput(['maxlength' => 128]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'city')->textInput(['maxlength' => 50]) ?>
        <?= $form->field($model, 'state')->textInput(['maxlength' => 10]) ?>
        <?= $form->field($model, 'zip')->textInput(['maxlength' => 10]) ?>
        <?= $form->field($model, 'email_id')->textInput(['maxlength' => 50]) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => 15]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= Html::a('Cancel', ['publisher/index'], ['class' => 'btn btn-warning']) ?>            
        </div>

    <?php ActiveForm::end(); ?>
</div>
