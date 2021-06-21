<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

declare(strict_types=1);

namespace EngineCore\modules\system;

use EngineCore\base\Modularity;

/**
 * Class Module
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class Module extends Modularity
{

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'EngineCore\modules\system\controllers';

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'setting-management';

}