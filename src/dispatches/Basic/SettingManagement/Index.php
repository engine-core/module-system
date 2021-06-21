<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\dispatches\Basic\SettingManagement;

use EngineCore\dispatch\Dispatch;
use EngineCore\Ec;
use EngineCore\enums\EnableEnum;
use EngineCore\enums\Enums;
use EngineCore\extension\setting\SettingProviderInterface;
use EngineCore\modules\system\models\SettingSearch;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Index
 */
class Index extends Dispatch
{

    public function run()
    {
        /** @var SettingSearch $searchModel */
        $searchModel = Ec::createObject(SettingSearch::class);
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->getBodyParams());
        $settingService = Ec::$service->getSystem()->getSetting();

        return $this->response->setAssign([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'configGroupList' => ArrayHelper::merge(
                [Enums::UNLIMITED => Yii::t('ec/app', 'Please choose')],
                $settingService->extra(SettingProviderInterface::CONFIG_GROUP_LIST)
            ),
            'configTypeList' => ArrayHelper::merge(
                [Enums::UNLIMITED => Yii::t('ec/app', 'Please choose')],
                $settingService->extra(SettingProviderInterface::CONFIG_TYPE_LIST)
            ),
            'statusList' => ArrayHelper::merge(
                [Enums::UNLIMITED => Yii::t('ec/app', 'Unlimited')],
                EnableEnum::list()
            ),
        ])->render();
    }

}