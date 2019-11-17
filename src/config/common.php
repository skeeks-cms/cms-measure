<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 27.08.2015
 */
return [

    'components' => [
        'measure' => [
            'class' => 'skeeks\cms\measure\components\MeasureComponent',
        ],

        'i18n' => [
            'translations' => [
                'skeeks/measure' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@skeeks/cms/measure/messages',
                    'fileMap'  => [
                        'skeeks/measure' => 'main.php',
                    ],
                ],
            ],
        ],

        'authManager' => [
            'config' => [
                'roles' => [
                    [
                        'name'  => \skeeks\cms\rbac\CmsManager::ROLE_ADMIN,
                        'child' => [
                            //Есть доступ к системе администрирования
                            'permissions' => [
                                "measure/admin-measure",
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];