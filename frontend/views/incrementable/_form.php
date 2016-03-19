<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incrementable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incrementable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'urlIcon')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'urlIconUnknown')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urlBio')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'urlBioUnknown')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urlArt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'initialCost')->textInput() ?>
    
    <?= $form->field($model, 'premiumCost')->textInput() ?>

    <?= $form->field($model, 'initialProduction')->textInput() ?>
    
    <?= $form->field($model, 'active')->dropDownList([1 => 'True', 0 => 'False']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
