<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 11.09.2015
 */
namespace skeeks\cms\measure\libs;

use yii\helpers\ArrayHelper;

/**
 * Class Loc
 * @package skeeks\cms\measure\libs
 */
class Loc
{

    static private $_messages = null;

    static private function _init()
    {
        if (self::$_messages === null)
        {
            self::$_messages = (array) include_once __DIR__ . "/langs/ru.php";
        }
    }

    /**
     * @param $code
     * @return string
     */
    static public function getMessage($code)
    {
        self::_init();

        return (string) ArrayHelper::getValue(self::$_messages, $code);
    }
}