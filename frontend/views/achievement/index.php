<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Achievements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Achievement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'flavor',
            'stats',
            // 'image',
            // 'incrementable1',
            // 'incrementable2',
            // 'incrementable3',
            // 'value1',
            // 'value2',
            // 'value3',
            // 'usesPercentage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
