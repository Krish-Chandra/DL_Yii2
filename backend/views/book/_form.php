<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */

?>

<div  style="width:500px">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <!-- <?= $form->field($model, 'category_id')->textInput(['maxlength' => 10]) ?>  -->
    <div class="form-group">
	    <?= Html::activeLabel($model, 'category_id', ['class' => 'control-label', 'for' => "book-category_id"]) ?>
		<?= Html::activeDropDownList($model, 'category_id', ArrayHelper::map($categoryModels, 'id', 'categoryname'), ['class' => 'form-control']) ?>
	</div>
    <!-- <?= $form->field($model, 'author_id')->textInput(['maxlength' => 10]) ?> -->
    <div class="form-group">
	    <?= Html::activeLabel($model, 'author_id', ['class' => 'control-label', 'for' => "book-author_id"]) ?>
		<?= Html::activeDropDownList($model, 'author_id', ArrayHelper::map($authorModels, 'id', 'authorname'), ['class' => 'form-control']) ?>
	</div>
    
    <div class="form-group field-book-publisher_id">
	    <?= Html::activeLabel($model, 'publisher_id', ['class' => 'control-label', 'for' => "book-publisher_id"]) ?>
		<?= Html::activeDropDownList($model, 'publisher_id', ArrayHelper::map($publisherModels, 'id', 'publishername'), ['class' => 'form-control']) ?>
	</div>

    <!-- <?= $form->field($model, 'publisher_id')->textInput(['maxlength' => 10]) ?> -->

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'total_copies')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'available_copies')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a('Cancel', ['book/index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
