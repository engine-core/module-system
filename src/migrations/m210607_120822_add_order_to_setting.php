<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\db\Migration;

class m210607_120822_add_order_to_setting extends Migration
{

    public function safeUp()
    {
        $this->addColumn($this->createTableNameWithCode('setting'), 'order',
            $this->smallInteger(3)->unsigned()->notNull()
            ->defaultValue(0)->comment(Yii::t('ec/app', 'Sort Order'))
        );
    }

    public function safeDown()
    {
        $this->dropColumn($this->createTableNameWithCode('setting'), 'order');
    }

}