<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\db\Migration;
use EngineCore\enums\EnableEnum;

class m210607_120821_add_status_to_setting extends Migration
{

    public function safeUp()
    {
        $this->addColumn($this->createTableNameWithCode('setting'), 'status',
            $this->boolean()->unsigned()->notNull()
                ->defaultValue(EnableEnum::ENABLE)->comment(Yii::t('ec/app', 'Status'))
        );
    }

    public function safeDown()
    {
        $this->dropColumn($this->createTableNameWithCode('setting'), 'status');
    }

}