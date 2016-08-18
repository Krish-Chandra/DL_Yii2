<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */ 

$this->title = 'Add Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Add';
?>
<?php if (!(empty($categoryModels) || empty($authorModels) || empty($publisherModels)))
{
?>
	<div style="width:700px;">

	    <div class="panel panel-primary">
	    	<div class="panel-heading">
	    		<b>Add Book</b>
	    	</div>
	    	<div class="panel-body">
			    <?= $this->render('_form', [
			    	'categoryModels' => $categoryModels,
			    	'authorModels' => $authorModels,	
			    	'publisherModels' => $publisherModels,
			        'model' => $model,
			    ]) ?>
	  		
	    	</div>
	    </div>
	</div>
<?php	
}
else if (strlen($errorMsg) > 0)
{
?>	
	<div class="alert alert-warning"><?= $errorMsg; ?></div>
<?php
}
?>	

