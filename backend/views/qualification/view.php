<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Qualification */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Qualifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qualification-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
	    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	    <?=
	    Html::a('Delete', ['delete', 'id' => $model->id], [
		    'class' => 'btn btn-danger',
		    'data' => [
			    'confirm' => 'Are you sure you want to delete this item?',
			    'method' => 'post',
		    ],
	    ])
	    ?>
	    <?= Html::a('Create Qualification', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?=
	DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			[
				'attribute' => 'status',
				'value' => $model->getStatusLabel(),
			],
		],
	])
	?>

</div>
