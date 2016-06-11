<?php

use yii\db\Migration;

/**
 * Handles the creation for table `feedback`.
 */
class m160610_114253_create_feedback extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'subject' => $this->smallInteger()->notNull(),
            'content' => $this->text()->notNull(),
            'file' => $this->string()->notNull(),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $this->insert('feedback', [
                'subject' => rand(0, 3),
                'content' => '<p>123</p>',
                'file' => '2a335c892599be973b4f7fed2472350c.jpg',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down() {
        return false;
    }

}
