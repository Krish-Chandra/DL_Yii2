<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = "Edit Role";
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="author-update" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Edit Role</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', ['model' => $model, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions,  'add' => false  ]) ?>
  		
    	</div>
    </div>
</div>

</div>
