<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\Ec;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model EngineCore\modules\system\models\Setting */
/* @var $configGroupList array */
/* @var $configTypeList array */

$this->params['breadcrumbs'] = Ec::$service->getMenu()->getPage()->setConditions([
    'level' => 4,
])->getBreadcrumbs();
$this->title = end($this->params['breadcrumbs'])['label'] . ' - ' . $model->title;
\yii\web\YiiAsset::register($this);
?>

<div class="setting-view">
    <p>
        <?= Html::a(Yii::t('ec/app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('ec/app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'options' => ['class' => 'table table-striped table-hover detail-view'],
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            [
                'attribute' => 'description',
                'value' => nl2br($model->description),
            ],
            'value:ntext',
            [
                'attribute' => 'extra',
                'format' => 'html',
                'value' => nl2br($model->extra),
            ],
            [
                'attribute' => 'category',
                'value' => $configGroupList[$model->category],
            ],
            [
                'attribute' => 'type',
                'value' => $configTypeList[$model->type],
            ],
        ],
    ])
    ?>

</div>
    