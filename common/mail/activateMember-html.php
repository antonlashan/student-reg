<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$loginLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/login']);
?>
<div class="password-reset">
    <p>Dear <?= $user->getTitleLabel() ?> <?= Html::encode($user->full_name) ?>,</p>
    <p>Your profile has been activated. </p>

    <p>Please follow the <?= Html::a('link', $loginLink) ?> to login to the <?= Yii::$app->name ?></p>

    <p>Regards</p>
    <p>Admin</p>
    <p><?= Yii::$app->name ?></p>
</div>
