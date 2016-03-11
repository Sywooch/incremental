<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = User::findOne($model->user)->username;
$this->params['breadcrumbs'][] = $this->title;

$model->updatePoints();
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('/widgets/counter/_mainCounter', [
        'game' => $model,
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user',
            'created_at',
            'updated_at',
            'points',
            'lastIncrease',
        ],
    ]) ?>
    
</div>
