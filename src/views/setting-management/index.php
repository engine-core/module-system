<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\Ec;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel EngineCore\modules\system\models\SettingSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $configGroupList array */
/* @var $configTypeList array */
/* @var $statusList array */

$this->params['breadcrumbs'] = Ec::$service->getMenu()->getPage()->setConditions([
    'level' => 3,
])->getBreadcrumbs();
$this->title = end($this->params['breadcrumbs'])['label'];

$column = [
    'name',
    [
        'attribute' => 'title',
        'format' => 'raw',
        'value' => function ($model) {
            return Html::a($model->title, ['view', 'id' => $model->id], ['data-pjax' => 0]);
        },
    ],
    [
        'format' => 'html',
        'attribute' => 'description',
        'value' => function ($model) {
            return nl2br($model->description);
        },
    ],
    [
        'attribute' => 'type',
        'value' => function ($model) use ($configTypeList) {
            return $configTypeList[$model->type];
        },
    ],
    [
        'attribute' => 'category',
        'value' => function ($model) use ($configGroupList) {
            return $configGroupList[$model->category];
        },
    ],
    'order',
    [
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'status',
    ],
    ['class' => \kartik\grid\ActionColumn::class],
];
?>

<div class="setting-index">
    <p>
        <?= Html::a(FA::i('plus') .
            Html::tag('span', ' ' . Yii::t('ec/app', 'New Add'), ['class' => 'hidden-xs']),
            ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button(FA::i('search'), [
            'class' => 'btn btn-info pull-right',
            'data-toggle' => 'collapse',
            'data-target' => '#setting-search',
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= $this->render('_search', [
        'model' => $searchModel,
        'configGroupList' => $configGroupList,
        'configTypeList' => $configTypeList,
        'statusList' => $statusList,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $column,
        'bordered' => false,
        'hover' => true,
        'emptyTextOptions' => ['class' => 'text-center text-muted'],
    ]);
    ?>

    <?php Pjax::end(); ?>
</div>