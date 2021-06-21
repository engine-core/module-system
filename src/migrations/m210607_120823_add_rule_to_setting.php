<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

use EngineCore\db\Migration;

class m210607_120823_add_rule_to_setting extends Migration
{

    public function safeUp()
    {
        $this->addColumn($this->createTableNameWithCode('setting'), 'rule',
            $this->string(500)->notNull()
            ->defaultValue('required')->comment(Yii::t('ec/modules/system', 'Rule'))
        );
    }

    public function safeDown()
    {
        $this->dropColumn($this->createTableNameWithCode('setting'), 'rule');
    }

}