<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

declare(strict_types=1);

namespace EngineCore\modules\system;

use EngineCore\Ec;
use EngineCore\enums\AppEnum;
use EngineCore\extension\repository\info\ModularityInfo;
use Yii;
use yii\helpers\ReplaceArrayValue;
use yii\web\Application;

class Info extends ModularityInfo
{

    const EXT_RAND_CODE = 'PduZgT_';

    protected
        $id = 'system',
        $name = '系统管理',
        $category = self::CATEGORY_SYSTEM;

    /**
     * @inheritdoc
     */
    public function getMenus(): array
    {
        $settingUrl = "/{$this->id}/setting";
        $managerUrl = "/{$this->id}/setting-management";

        return [
            AppEnum::BACKEND => [
                // 系统管理
                'system' => [
                    'label' => Yii::t('ec/modules/system', 'System Management'),
                    'icon' => 'cog',
                    'visible' => true,
                    'items' => [
                        // 网站设置
                        'setting' => [
                            'label' => Yii::t('ec/modules/system', 'Website Settings'),
                            'icon' => 'sliders',
                            'visible' => true,
                            'order' => 1000,
                            'items' => [
                                ['label' => Yii::t('ec/modules/system', 'Basic Settings'), 'url' => "{$settingUrl}/basic", 'visible' => true],
                                ['label' => Yii::t('ec/modules/system', 'Content Settings'), 'url' => "{$settingUrl}/content", 'visible' => true],
                                ['label' => Yii::t('ec/modules/system', 'Registration Settings'), 'url' => "{$settingUrl}/registration", 'visible' => true],
                                ['label' => Yii::t('ec/modules/system', 'System Settings'), 'url' => "{$settingUrl}/system", 'visible' => true],
                                ['label' => Yii::t('ec/modules/system', 'Security Settings'), 'url' => "{$settingUrl}/security", 'visible' => true],
                            ],
                        ],
                        // 基础功能
                        'basic' => [
                            'label' => Yii::t('ec/modules/system', 'Basic Functions'),
                            'icon' => 'cogs',
                            'visible' => true,
                            'order' => 1001,
                            'items' => [
                                // 配置管理
                                'manage' => [
                                    'label' => Yii::t('ec/modules/system', 'Setup Management'),
                                    'url' => "{$managerUrl}/index",
                                    'visible' => true,
                                    'order' => 1000,
                                    'items' => [
                                        ['label' => Yii::t('ec/app', 'Index'), 'url' => "{$managerUrl}/index"],
                                        ['label' => Yii::t('ec/app', 'View'), 'url' => "{$managerUrl}/view"],
                                        ['label' => Yii::t('ec/app', 'New Add'), 'url' => "{$managerUrl}/create"],
                                        ['label' => Yii::t('ec/app', 'Update'), 'url' => "{$managerUrl}/update"],
                                        ['label' => Yii::t('ec/app', 'Delete'), 'url' => "{$managerUrl}/delete"],
                                        ['label' => Yii::t('ec/app', 'Search'), 'url' => "{$managerUrl}/search"],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function getConfig(): array
    {
        return [
            AppEnum::BACKEND => [
                'modules' => [
                    $this->getId() => [
                        'class' => 'EngineCore\modules\system\Module',
                    ],
                ],
                'components' => [
                    'i18n' => [
                        'translations' => [
                            'ec/modules/system' => [
                                'class' => 'yii\\i18n\\PhpMessageSource',
                                'sourceLanguage' => 'en-US',
                                'basePath' => '@EngineCore/modules/system/messages',
                                'fileMap' => [
                                    'ec/modules/system' => 'app.php',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            AppEnum::COMMON => [
                'container' => [
                    'definitions' => [
                        'SettingProvider' => new ReplaceArrayValue([
                            'class' => 'EngineCore\modules\system\models\Setting',
                        ]),
                    ],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function install(): bool
    {
        if (false === parent::install()) {
            return false;
        }

        return Ec::$service->getMigration()->table($this->getMigrationTable())
            ->interactive(false)
            ->path($this->getMigrationPath())
            ->compact(Yii::$app instanceof Application)
            ->up(0);
    }

    /**
     * @inheritdoc
     */
    public function uninstall(): bool
    {
        if (false === parent::uninstall()) {
            return false;
        }

        $res = Ec::$service->getMigration()->table($this->getMigrationTable())
            ->interactive(false)
            ->path($this->getMigrationPath())
            ->compact(Yii::$app instanceof Application)
            ->down('all');
        if ($res) {
            Ec::$service->getMigration()->getMigrate()->db->createCommand()->dropTable($this->getMigrationTable())->execute();
        }

        return $res;
    }

}