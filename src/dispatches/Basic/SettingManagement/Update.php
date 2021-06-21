<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\dispatches\Basic\SettingManagement;

use EngineCore\base\LoadModelTrait;
use EngineCore\dispatch\Dispatch;
use EngineCore\Ec;
use EngineCore\extension\setting\SettingProviderInterface;
use EngineCore\modules\system\models\Setting;
use Yii;

/**
 * Class Update
 */
class Update extends Dispatch
{

    use LoadModelTrait;

    /**
     * @param integer $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        /** @var Setting $model */
        $model = $this->loadModel(Setting::class, $id);
        $request = Yii::$app->getRequest();

        if ($model->load($request->getBodyParams())) {
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
