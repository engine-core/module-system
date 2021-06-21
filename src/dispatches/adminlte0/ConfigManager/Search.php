<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\dispatches\adminlte\ConfigManager;

use EngineCore\modules\system\models\SettingSearch;
use wocenter\core\web\Dispatch;
use wocenter\Wc;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Search
 */
class Search extends Dispatch
{
    
    public function run()
    {
        $searchModel = new SettingSearch();
        $searchModel->load(Yii::$app->getRequest()->getQueryParams());
        
        return $this->setAssign([
            'model' => $searchModel,
            'action' => ['index'],
            'configGroupList' => Wc::$service->getSystem()->getConfig()->extra('CONFIG_GROUP_LIST'),
            'configTypeList' => Wc::$service->getSystem()->getConfig()->extra('CONFIG_TYPE_LIST'),
            'statusList' => ArrayHelper::merge(
                [Constants::UNLIMITED => Yii::t('wocenter/app', 'Unlimited')],
                Constants::getStatusList()
            ),
        ])->display('_search');
    }
    
}
