<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="role-form" style="width:500px">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'rolename')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
		<div class="form-group">
			<label class="control-label">Permission</label>
			<br />

<?php		
            if ($add)
            {
                echo Html::checkboxList("permission[]", [], ArrayHelper::map($permissions, 'name', 'name'));
            }
            else
            {
                //print_r($rolePermissions);
                echo Html::checkboxList("permission[]", array_keys($rolePermissions), ArrayHelper::map($permissions, 'name', 'name'));
            }
            
            //foreach($permissions as $val)
            //{
?>				
				 <!--<input type="checkbox" name="permission[]" value="<?php //echo $val->name ?>" /> <?php //echo $val->name ?> &nbsp;&nbsp;--> 
				<!--<input type="radio" name="permission" value="<?php //echo $val->name ?>" /> <?php //echo $val->name ?> &nbsp;&nbsp; -->

				
<?php				
            //}
?>			
		
		</div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= Html::a('Cancel', ['role/index'], ['class' => 'btn btn-warning']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
