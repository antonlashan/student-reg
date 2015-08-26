<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserCategory */

$this->title = 'Create User Category';
$this->params['breadcrumbs'][] = ['label' => 'User Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
