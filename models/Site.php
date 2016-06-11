<?php

namespace app\models;

/**
 * Модель главной страницы
 *
 * @author Ilya Marinin<http://marinin.pw>
 */
class Site {

    /**
     * Получить дату
     * @return string
     */
    public function getDate() {
        $key = 'date';
        $cache = \Yii::$app->cache;

        $date = $cache->get($key);

        if ($date === false) {
            $date = date('Y-m-d H:i:s');
            $cache->set($key, $date);
        }

        return $date;
    }

}
