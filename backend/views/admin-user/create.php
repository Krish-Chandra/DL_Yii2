<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminUser */

$this->title = "Add Admin User";
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Add';
?>

<div class="author-update" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Add Admin User</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model, 'role' => $roles, 'add' => true
		    ]) ?>
  		
    	</div>
    </div>
</div>

</div>
