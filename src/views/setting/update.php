<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\Ec;
use yii\web\View;

/* @var $this View */
/* @var $models EngineCore\extension\setting\SettingForm */
/* @var $breadcrumbs array */
/* @var $title string */

$this->params['breadcrumbs'] = Ec::$service->getMenu()->getPage()->setConditions([
    'url' => '/' . Yii::$app->requestedRoute,
    'level' => 3,
])->getBreadcrumbs();
$this->title = end($this->params['breadcrumbs'])['label'];
?>

<?= $this->render('_form', [
    'models' => $models,
])
?>