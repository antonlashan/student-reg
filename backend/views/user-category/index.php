<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-category-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
	    <?= Html::a('Create Member Category', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'status',
				'value' => function($data) {
					return $data->getStatusLabel();
				}
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]);
	?>

</div>
