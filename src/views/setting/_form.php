<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use ekevin\nestable\Nestable;
use EngineCore\helpers\StringHelper;
use EngineCore\modules\system\models\Setting;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model Setting */
/* @var $models EngineCore\extension\setting\SettingForm */
?>

<?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]
);

foreach ($models->models as $model) {
    switch ($model->type) {
        case Setting::TYPE_STRING:
            echo $form->field($models, $model->name)->textInput();
            break;
        case Setting::TYPE_TEXT:
            echo $form->field($models, $model->name)->textarea(['rows' => 4]);
            break;
        case Setting::TYPE_SELECT:
            echo $form->field($models, $model->name)->widget(Select2::class, [
                'hideSearch' => true,
            ])->dropDownList(StringHelper::parseString($model->extra));
            break;
        case Setting::TYPE_CHECKBOX:
            echo $form->field($models, $model->name)->checkboxList(StringHelper::parseString($model->extra), ['inline' => true]);
            break;
        case Setting::TYPE_RADIO:
            echo $form->field($models, $model->name)->radioList(StringHelper::parseString($model->extra), ['inline' => true]);
            break;
        case Setting::TYPE_KANBAN:
            echo $form->field($models, $model->name)
                ->widget(Nestable::class, [
                    'items' => Json::decode($model->value),
                    'pluginOptions' => [
                        'group' => 1,
                        'maxDepth' => 1,
                    ],
                ]);
            break;
    }
}; ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('ec/app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton(Yii::t('ec/app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?>