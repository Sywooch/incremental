<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Achievement */

$this->title = 'Create Achievement';
$this->params['breadcrumbs'][] = ['label' => 'Achievements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
