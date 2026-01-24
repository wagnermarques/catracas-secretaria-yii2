<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%funcionarios}}`.
 */
class m260124_153719_create_funcionarios_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%funcionarios}}', [
            'id' => $this->primaryKey(),
            'pessoa_id' => $this->integer()->notNull(),
            'cargo' => $this->string(255)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // Add foreign key for table `pessoas`
        $this->addForeignKey(
            'fk-funcionarios-pessoa_id',
            '{{%funcionarios}}',
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
        // drops foreign key for table `pessoas`
        $this->dropForeignKey(
            'fk-funcionarios-pessoa_id',
            '{{%funcionarios}}'
        );

        $this->dropTable('{{%funcionarios}}');
    }
}
