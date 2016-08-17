<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = "Edit Category";
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Edit Category</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
  		
    	</div>
    </div>
</div>

</div>
