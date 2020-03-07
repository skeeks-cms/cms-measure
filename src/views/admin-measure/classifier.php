<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */
?>

<? foreach (\Yii::$app->measureClassifier->data as $key => $data) : ?>
    <h2>
        <?= \yii\helpers\ArrayHelper::getValue($data, 'title'); ?>
        <? \yii\helpers\ArrayHelper::remove($data, 'title'); ?>

        <? foreach ($data as $key => $group) : ?>
            <h4 style="margin-left: 40px;"><?= \yii\helpers\ArrayHelper::getValue($group, 'title'); ?></h4>
            <? \yii\helpers\ArrayHelper::remove($group, 'title'); ?>

            <? foreach ((array) $group as $key => $measure) : ?>
                <p style="margin-left: 80px;">

                    <b><?= \yii\helpers\ArrayHelper::getValue($measure, 'symbol'); ?></b>
                    -
                    <?= \yii\helpers\ArrayHelper::getValue($measure, 'name'); ?>
                    -
                    <?= \yii\helpers\ArrayHelper::getValue($measure, 'code'); ?>
                </p>
            <? endforeach; ?>

        <? endforeach; ?>
    </h2>
<? endforeach; ?>
