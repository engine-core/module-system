<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\dispatches\Basic\SettingManagement;

use EngineCore\dispatch\Dispatch;
use EngineCore\Ec;
use EngineCore\extension\setting\SettingProviderInterface;
use EngineCore\modules\system\models\Setting;
use Yii;

/**
 * Class Create
 */
class Create extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        /** @var Setting $model */
        $model = Yii::createObject(Setting::class);
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->getRequest()->getBodyParams())) {
            if ($model->save()) {
                $this->response->setJumpUrl(["/{$this->controller->module->id}"])->success();
            } else {
                $this->response->error();
            }
        }

        return $this->response->setAssign([
            'model' => $model,
            'configGroupList' => Ec::$service->getSystem()->getSetting()->extra(SettingProviderInterface::CONFIG_GROUP_LIST),
            'configTypeList' => Ec::$service->getSystem()->getSetting()->extra(SettingProviderInterface::CONFIG_TYPE_LIST),
        ])->render();
    }

}
