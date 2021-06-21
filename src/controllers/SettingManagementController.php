<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

namespace EngineCore\modules\system\controllers;

use EngineCore\web\Controller;
use yii\filters\VerbFilter;

/**
 * Class SettingManagementController
 *
 * @property \EngineCore\modules\system\Module $module
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class SettingManagementController extends Controller
{

    protected $defaultDispatchMap = ['index', 'adminlte/search', 'view', 'create', 'update',
        'delete' => [
            'class' => 'EngineCore\web\dispatches\DeleteOne',
            'modelClass' => 'EngineCore\modules\system\models\Setting',
            'markAsDeleted' => false,
            'successJumpUrl' => 'index',
        ],
    ];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

}