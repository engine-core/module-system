<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\enums\EnableEnum;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model \EngineCore\modules\system\models\Setting */
/* @var $configGroupList array */
/* @var $configTypeList array */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 1, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'type')->widget(Select2::class, [
        'hideSearch' => true,
    ])->dropDownList($configTypeList) ?>

    <?= $form->field($model, 'category')->widget(Select2::class, [
        'hideSearch' => true,
    ])->dropDownList($configGroupList) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'extra')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'rule')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'status')->radioList(EnableEnum::list(), ['inline' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('ec/app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton(Yii::t('ec/app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
