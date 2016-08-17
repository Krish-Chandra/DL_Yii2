<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AdminUser */
/* @var $form yii\widgets\ActiveForm */

?>

<div  style="width:500px">
    <?php $form = ActiveForm::begin(); ?>
    	<div>
<?php	
			if ($add)    	
			{
        		echo $form->field($model, 'username' );    										
    		}
			else
			{
	            echo Html::activeLabel($model, 'username');
	            echo '<br />';
	    		echo $model->username;

			}
?>			
        </div>
		<div>
<!--			<label for="password" class="control-label">Password</label>
			<br />
			<input type="password" name="password" class="form-control" />-->
            <?= $form->field($model, 'password')->passwordInput() ?>
		</div>        
 

        <?= $form->field($model, 'email')->textInput() ?>   
        <div class="form-group">
            <?= Html::activeLabel($model, 'role_id', ['class' => 'control-label']) ?>
            <?= Html::activeDropDownList($model, 'role_id', ArrayHelper::map($role, 'id', 'rolename'), ['class' => 'form-control']) ?>
        </div>

        <?= $form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No'])->label('Active?') ?>    		

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= Html::a('Cancel', ['admin-user/index'], ['class' => 'btn btn-warning']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
