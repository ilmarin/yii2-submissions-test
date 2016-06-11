<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;
use yii\data\ActiveDataProvider;

/**
 * Feedback model
 *
 * @author Ilya Marinin<http://marinin.pw>
 */
class Feedback extends ActiveRecord {

    const STATUS_QUESTION = 0;
    const STATUS_WISH = 1;
    const STATUS_ERROR_REPORT = 2;
    const STATUS_PARTNERSHIP = 3;

    /**
     * Элементов на странице в списке обращений
     */
    const PAGE_SIZE = 3;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['subject', 'content'], 'required', 'message' => 'Необходимо заполнить {attribute}'],
            [['subject'], 'integer', 'min' => 0, 'max' => 3],
            [['content'], 'string', 'length' => [1, 2000]],
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'png, jpg, gif, pdf',
                'mimeTypes' => 'image/jpeg, image/png, image/gif, application/pdf',
                'message' => 'Ошибка загрузки файла',
                'wrongExtension' => 'Допустимые расширения файла: {extensions}',
                'wrongMimeType' => 'Допустимые mime-типы файла: {mimeTypes}',
                'uploadRequired' => 'Файл обязателен',
            ],
        ];
    }

    public static function tableName() {
        return 'feedback';
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'subject' => 'Тема',
            'content' => 'Обращение',
            'file' => 'Файл',
        ];
    }

    public static function feedbackCategories() {
        return [
            self::STATUS_QUESTION => 'Вопрос',
            self::STATUS_WISH => 'Пожелание',
            self::STATUS_ERROR_REPORT => 'Сообщение об ошибке',
            self::STATUS_PARTNERSHIP => 'Сотрудничество',
        ];
    }

    /**
     * Получить провайдер с данными
     * @return array
     */
    public function getProvider() {
        $query = self::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::PAGE_SIZE,
            ],
        ]);

        return $provider;
    }

    /**
     * Загрузка файла
     * @return boolean
     */
    public function upload() {
        $this->file->saveAs(Yii::$app->params['uploadDir'] . $this->file->baseName . '.' . $this->file->extension);

        return true;
    }

    public static function getSubjectById($id) {
        $categories = self::feedbackCategories();

        return $categories[$id];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->content = HtmlPurifier::process($this->content);
            return true;
        }
        return false;
    }

}
