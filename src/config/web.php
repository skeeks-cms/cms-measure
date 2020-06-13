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
                                "url"   => ["cms-measure/admin-measure"],
                                "image" => ['\skeeks\cms\measure\assets\Asset', 'icons/misc.png'],
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