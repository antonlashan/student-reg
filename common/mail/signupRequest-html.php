<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
	<p>User <?= Html::encode($user->full_name) ?> has requested a become a member. </p>

	<p><?php // Html::a(Html::encode($resetLink), $resetLink)  ?></p>
</div>
