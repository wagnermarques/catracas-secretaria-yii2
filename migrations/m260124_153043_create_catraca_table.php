<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catraca}}`.
 */
class m260124_153043_create_catraca_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catraca}}', [
            'id' => $this->primaryKey(),
            'catraca_id' => $this->integer()->notNull()->unique(),
            'catraca_status' => $this->string()->notNull()->defaultValue('desligada'),
            'catraca_direction' => $this->string()->notNull()->defaultValue('entrada'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catraca}}');
    }
}
