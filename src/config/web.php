<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */
return [
    'components' => [
        'backendAdmin' => [
            'menu' => [
                'data' => [

                    'settings' => [
                        'items' => [
                            [
                                "name"  => ['skeeks/measure', 'Units of measurement'],
                                "image" => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],

                                'items' => [
                                    [
                                        "name"  => ['skeeks/measure', 'Units of measurement'],
                                        "url"   => ["cms-measure/admin-measure"],
                                        "image" => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],
                                    ],

                                    [
                                        "name"           => ['skeeks/measure', 'Settings'],
                                        "url"            => ["cms/admin-settings", "component" => 'skeeks\cms\measure\components\MeasureComponent'],
                                        "image"          => ['skeeks\cms\assets\CmsAsset', 'images/icons/settings.png'],
                                        "activeCallback" => function ($adminMenuItem) {
                                            return (bool)(\Yii::$app->request->getUrl() == $adminMenuItem->getUrl());
                                        },
                                    ],
                                ],
                            ],
                        ],
                    ],

                ],
            ],
        ],
    ],
    'modules'    => [
        'cms-measure' => [
            'class' => 'skeeks\cms\measure\Module',
        ],
    ],
];