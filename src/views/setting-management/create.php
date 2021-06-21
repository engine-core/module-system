<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\Ec;

/* @var $this yii\web\View */
/* @var $configGroupList array */
/* @var $configTypeList array */

$this->params['breadcrumbs'] = Ec::$service->getMenu()->getPage()->setConditions([
    'level' => 4,
])->getBreadcrumbs();
$this->title = end($this->params['breadcrumbs'])['label'] . '设置项';
?>

<div class="setting-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'configGroupList' => $configGroupList,
        'configTypeList' => $configTypeList,
    ]); ?>

</div>
