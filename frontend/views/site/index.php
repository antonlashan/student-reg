<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home';
?>
<div class="user-index">
	<div class="jumbotron">
		<h1>IPSL Member Portal</h1>
		<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
		<p><?= Html::a('Sign up today', ['signup'], ['class' => 'btn btn-lg btn-primary']) ?></p>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="col-lg-5">
				<h2>Using Member Portal</h2>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur.</p>

			</div>
			<div class="col-lg-7">
				<h2>Search IPSL Members</h2>

				<?php echo $this->render('_search', ['model' => $searchModel]); ?>

				<?php if ($dataProvider) { ?>
					<?=
					ListView::widget([
						'dataProvider' => $dataProvider,
						'itemOptions' => ['class' => 'item'],
						'itemView' => function ($model, $key, $index, $widget) {
						return Html::a(Html::encode($model->full_name), ['view-member', 'id' => $model->id]);
					},
					])
					?>
				<?php } ?>
			</div>
		</div>

	</div>

</div>
