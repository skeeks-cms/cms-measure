<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 12.03.2015
 */
return [

    'other' =>
    [
        'items' =>
        [
            [
                "label"     => "Единицы измерений",
                "img"       => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],

                'items' =>
                [
                    [
                        "label"     => "Единицы измерений",
                        "url"       => ["measure/admin-measure"],
                        "img"       => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],
                    ],

                    [
                        "label" => "Настройки",
                        "url"   => ["cms/admin-settings", "component" => 'skeeks\cms\measure\components\MeasureComponent'],
                        "img"       => ['\skeeks\cms\modules\admin\assets\AdminAsset', 'images/icons/settings.png'],
                        "activeCallback"       => function(\skeeks\cms\modules\admin\helpers\AdminMenuItem $adminMenuItem)
                        {
                            return (bool) (\Yii::$app->request->getUrl() == $adminMenuItem->getUrl());
                        },
                    ],
                ]
            ],
        ]
    ]
];