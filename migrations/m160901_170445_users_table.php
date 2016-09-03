<?php

use yii\db\Migration;

class m160901_170445_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'phone' => $this->string(20),
            'email' => $this->string(255),
            'position' => $this->string(50),
            'img_hash' => $this->string(32),
            'parent_id' => $this->integer()
        ]);
    }

    public function down()
    {
        echo "m160901_170445_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
