<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */ 

$this->title = 'Add Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Add';
?>
<div class="book-create" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Add a New Role</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', ['model' => $model, 'permissions' => $permissions, 'add' => true]) ?>
    	</div>
    </div>
</div>
<?php

?>