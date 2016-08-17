<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="author-form" style="width:500px">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'categoryname')->textInput(['maxlength' => 75]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => 150]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= Html::a('Cancel', ['category/index'], ['class' => 'btn btn-warning']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
