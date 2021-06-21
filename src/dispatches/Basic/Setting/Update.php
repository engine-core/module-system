<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\dispatches\Basic\Setting;

use EngineCore\dispatch\Dispatch;
use EngineCore\Ec;
use EngineCore\extension\setting\SettingForm;
use EngineCore\extension\setting\SettingProviderInterface;
use Yii;

/**
 * Class Update
 */
class Update extends Dispatch
{

    /**
     * @var int 设置分组
     * @see SettingProviderInterface
     */
    public $category = SettingProviderInterface::CATEGORY_BASE;

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        /** @var SettingForm $models */
        $models = Ec::createObject(SettingForm::class, [$this->category]);
        if ($models->load(Yii::$app->getRequest()->getBodyParams())) {
            if ($models->save()) {
                $this->response->success(Yii::t('ec/app', 'Saved successful.'));
            } else {
                $this->response->error(Yii::t('ec/app', 'Saved failure.'));
            }
        }

        return $this->response->setAssign([
            'models' => $models,
        ])->render('update');
    }

}