<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

declare(strict_types=1);

namespace EngineCore\modules\system\models;

use EngineCore\Ec;
use EngineCore\enums\EnableEnum;
use EngineCore\extension\setting\SettingModel;
use Yii;

/**
 * This is the model class for table "{{%viMJHk_setting}}".
 *
 * @property integer $status
 * @property integer $order
 * @property string $rule
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class Setting extends SettingModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['otherInteger'][0] = array_merge($rules['otherInteger'][0], ['status', 'order']);

        return array_merge($rules, [
            // rule rules
            'ruleRequired' => ['rule', 'required'],
            'ruleString' => ['rule', 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'status' => Yii::t('ec/app', 'Status'),
            'order' => Yii::t('ec/app', 'Sort Order'),
            'rule' => Yii::t('ec/modules/system', 'Rule'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'order' => Yii::t('ec/modules/system', 'Set the sort of items.'),
            'rule' => Yii::t('ec/modules/system', 'Set validation rules. Many rules are signed in English ; or newline separation.'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return Ec::$service->getSystem()->getCache()->getOrSet(self::SETTING_KEY, function () {
            return self::find()->where(['status' => EnableEnum::ENABLE])
                ->indexBy('name')->orderBy('order')->asArray()->all();
        }, $this->getCacheDuration());
    }

}