<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\Ec;

/* @var $this yii\web\View */
/* @var $model EngineCore\modules\system\models\Setting */
/* @var $configGroupList array */
/* @var $configTypeList array */

$this->params['breadcrumbs'] = Ec::$service->getMenu()->getPage()->setConditions([
    'level' => 4,
])->getBreadcrumbs();
$this->title = end($this->params['breadcrumbs'])['label'] . ' - ' . $model->title;
?>

<div class="setting-update">

    <?= $this->render('_form', [
        'model' => $model,
        'configGroupList' => $configGroupList,
        'configTypeList' => $configTypeList,
    ]) ?>

</div>
    