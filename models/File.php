<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * Модель для работы с файлом
 *
 * @author Ilya Marinin<http://marinin.pw>
 */
class File {

    private $filename;

    public function __construct($filename) {
        $this->filename = Yii::$app->params['uploadDir'] . $filename;
    }

    public function getFileSize() {
        return round((filesize($this->filename) / 1024), 2);
    }

    public function getMimeType() {
        return FileHelper::getMimeType($this->filename);
    }

}
