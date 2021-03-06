<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserCategory */

$this->title = 'Create Member Category';
$this->params['breadcrumbs'][] = ['label' => 'Member Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
