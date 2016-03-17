<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@base', dirname(dirname(__DIR__)));
Yii::setAlias('@url', "http://tenbillionbottles.com");

require Yii::getAlias('@base') . '/vendor/autoload.php';
