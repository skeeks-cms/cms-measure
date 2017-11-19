<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\helpers\Html;
use skeeks\cms\modules\admin\widgets\form\ActiveFormUseTab as ActiveForm;

/* @var $this yii\web\View */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->fieldSet(\Yii::t('skeeks/measure','Main')); ?>

    <?= $form->fieldInputInt($model, 'code')->textInput(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 500]); ?>
    <?= $form->field($model, 'symbol_rus')->textInput(['maxlength' => 20]); ?>
    <?= $form->field($model, 'symbol_intl')->textInput(['maxlength' => 20]); ?>
    <?= $form->field($model, 'symbol_letter_intl')->textInput(['maxlength' => 20]); ?>

<?= $form->fieldSetEnd(); ?>

<?= $form->buttonsCreateOrUpdate($model); ?>
<?php ActiveForm::end(); ?>
