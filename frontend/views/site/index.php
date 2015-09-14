<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home';
?>
<div class="user-index">
	<div class="jumbotron">
		<h1>IPSL is the apex body of Physicists in Sri Lanka</h1>
		<?= Html::img('@web/img/logo.png') ?>
		<h2>Welcome to IPSL Membership Portal</h2>
		<p class="lead">This Membership Portal contains services for members of the Institute of Physics, Sri Lanka. Membership is open to anyone with an interest in Physics, for more information please go to Membership.</p>
		<p></p><br/>
		<p>To enter the Membership Portal please sign in using registered email and password: </p>
		<p><?= Html::a('Membership Login', ['login'], ['class' => 'btn btn-lg btn-primary']) ?></p>
		<p>If you are a new member sign up today.</p>
		<p><?= Html::a('Sign up today', ['signup'], ['class' => 'btn btn-lg btn-primary']) ?></p>
	</div>

	<div class="body-content">

		<div class="row">
			
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
