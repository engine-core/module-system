<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model EngineCore\modules\system\models\SettingSearch */
/* @var $form ActiveForm */
/* @var $configGroupList array */
/* @var $configTypeList array */
/* @var $statusList array */
?>

<div class="collapse setting-search" id="setting-search">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 1, 'deviceSize' => ActiveForm::SIZE_SMALL],
        'action' => ['index'],
//        'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'name')->hint(false) ?>

    <?= $form->field($model, 'title')->hint(false) ?>

    <?= $form->field($model, 'category')->widget(Select2::class, [
        'options' => [
            'placeholder' => Yii::t('ec/app', 'Please choose'),
        ],
        'hideSearch' => true,
    ])->dropDownList($configGroupList)->hint(false)
    ?>

    <?= $form->field($model, 'type')->widget(Select2::class, [
        'options' => [
            'placeholder' => Yii::t('ec/app', 'Please choose'),
        ],
        'hideSearch' => true,
    ])->dropDownList($configTypeList)->hint(false)
    ?>

    <?= $form->field($model, 'status')->radioList($statusList, ['inline' => true])->hint(false) ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('ec/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('ec/app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::button(Yii::t('ec/app', 'Close'), [
            'class' => 'btn btn-outline-secondary',
            'data-toggle' => 'collapse',
            'data-target' => '#setting-search',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    