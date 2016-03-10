<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Incrementable */

$this->title = 'Create Incrementable';
$this->params['breadcrumbs'][] = ['label' => 'Incrementables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incrementable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
