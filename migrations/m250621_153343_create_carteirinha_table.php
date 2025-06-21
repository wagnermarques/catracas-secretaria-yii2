<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carteirinha}}`.
 */
class m250621_153343_create_carteirinha_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carteirinha}}', [
            'id' => $this->primaryKey(),
            'id_aluno' => $this->integer()->notNull(),
            'ativa' => $this->boolean()->defaultValue(false)->notNull(),
            'carteirinha_id' => $this->string(255)->notNull()->unique(),
            'observacao' => $this->text()->null(),
            'data_emissao' => $this->dateTime()->notNull(),
            'data_validade' => $this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carteirinha}}');
    }
}
