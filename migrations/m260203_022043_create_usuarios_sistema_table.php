<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%usuarios_sistema}}`.
 */
class m260203_022043_create_usuarios_sistema_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%usuarios_sistema}}', [
            'id' => $this->primaryKey(),
            'pessoa_id' => $this->integer()->notNull(),
            'loginname' => $this->string(100)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->null(),
            'access_token' => $this->string(100)->null(),
        ]);

        $this->addForeignKey(
            'fk-usuarios_sistema-pessoa_id',
            '{{%usuarios_sistema}}',
            'pessoa_id',
            '{{%pessoas}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-usuarios_sistema-pessoa_id', '{{%usuarios_sistema}}');
        $this->dropTable('{{%usuarios_sistema}}');
    }
}
