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
                "label"     => \Yii::t('skeeks/measure', 'Units of measurement'),
                "img"       => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],

                'items' =>
                [
                    [
                        "label"     => \Yii::t('skeeks/measure', 'Units of measurement'),
                        "url"       => ["measure/admin-measure"],
                        "img"       => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],
                    ],

                    [
                        "label" => \Yii::t('skeeks/measure', 'Settings'),
                        "url"   => ["cms/admin-settings", "component" => 'skeeks\cms\measure\components\MeasureComponent'],
                        "img"       => ['skeeks\cms\assets\CmsAsset', 'images/icons/settings.png'],
                        "activeCallback"       => function($adminMenuItem)
                        {
                            return (bool) (\Yii::$app->request->getUrl() == $adminMenuItem->getUrl());
                        },
                    ],
                ]
            ],
        ]
    ]
];