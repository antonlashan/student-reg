<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
	    <?php $this->beginBody() ?>

		<div class="wrap">
		    <?php
		    NavBar::begin([
			    'brandLabel' => Yii::$app->name,
			    'brandUrl' => Yii::$app->homeUrl,
			    'options' => [
				    'class' => 'navbar-inverse navbar-fixed-top',
			    ],
			    'innerContainerOptions' => ['class' => 'container-fluid'],
		    ]);
		    $menuItems = [
			    ['label' => 'Home', 'url' => ['/site/index']],
			    ['label' => 'Members', 'url' => ['/user/index']],
			    ['label' => 'Qualifications', 'url' => ['/qualification/index']],
			    ['label' => 'Specializations', 'url' => ['/specialization/index']],
			    ['label' => 'Member Categories', 'url' => ['/user-category/index']],
		    ];
		    if (Yii::$app->user->isGuest) {
			    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
		    } else {
			    $menuItems[] = [
				    'label' => 'Logout (' . Yii::$app->user->identity->full_name . ')',
				    'url' => ['/site/logout'],
				    'linkOptions' => ['data-method' => 'post']
			    ];
		    }
		    echo Nav::widget([
			    'options' => ['class' => 'navbar-nav navbar-right'],
			    'items' => $menuItems,
		    ]);
		    NavBar::end();
		    ?>

			<div class="container-fluid" id="container">
			    <?=
			    Breadcrumbs::widget([
				    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			    ])
			    ?>
			    <?= Alert::widget() ?>
			    <?= $content ?>
			</div>
		</div>

		<footer class="footer">
			<div class="container-fluid">
				<p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

			</div>
		</footer>

		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
