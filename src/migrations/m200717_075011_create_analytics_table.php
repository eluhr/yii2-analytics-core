<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%analytics}}`.
 */
class m200717_075011_create_analytics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%analytic_data}}', [
            'id' => $this->char(36)->append('PRIMARY KEY NOT NULL'),
            'type' => $this->string(128)->notNull(),
            'data' => $this->binary()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%analytic_data}}');
    }
}
