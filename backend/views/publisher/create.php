<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publisher */ 

$this->title = 'Add Publisher';
$this->params['breadcrumbs'][] = ['label' => 'Publishers', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Add';
?>
<div class="book-create" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Add a New Publisher</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
  		
    	</div>
    </div>
</div>
<?php

?>