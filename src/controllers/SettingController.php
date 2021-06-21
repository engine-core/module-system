<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\controllers;

use EngineCore\extension\setting\SettingProviderInterface;
use EngineCore\web\Controller;

/**
 * Class SettingController
 *
 * @property \EngineCore\modules\system\Module $module
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class SettingController extends Controller
{

    protected $defaultDispatchMap = [
        // 基本配置
        'basic' => [
            'map' => 'update',
        ],
        // 内容配置
        'content' => [
            'map' => 'update',
            'category' => SettingProviderInterface::CATEGORY_CONTENT,
        ],
        // 注册配置
        'registration' => [
            'map' => 'update',
            'category' => SettingProviderInterface::CATEGORY_REGISTRATION,
        ],
        // 系统配置
        'system' => [
            'map' => 'update',
            'category' => SettingProviderInterface::CATEGORY_SYSTEM,
        ],
        // 安全配置
        'security' => [
            'map' => 'update',
            'category' => SettingProviderInterface::CATEGORY_SECURITY,
        ],
    ];

}