Units of measurement for SkeekS CMS
===================================

[![Latest Stable Version](https://img.shields.io/packagist/v/skeeks/cms-measure.svg)](https://packagist.org/packages/skeeks/cms-measure)
[![Total Downloads](https://img.shields.io/packagist/dt/skeeks/cms-measure.svg)](https://packagist.org/packages/skeeks/cms-measure)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/cms-measure "*"
```

or add

```
"skeeks/cms-measure": "*"
```

Configuration app
----------

```php

'components' =>
[
    'measure' => [
        'class'         => 'skeeks\cms\measure\components\MeasureComponent',
    ],
    'i18n' => [
        'translations' =>
        [
            'skeeks/measure' => [
                'class'             => 'yii\i18n\PhpMessageSource',
                'basePath'          => '@skeeks/cms/measure/messages',
                'fileMap' => [
                    'skeeks/measure' => 'main.php',
                ],
            ]
        ]
    ],
],
'modules' =>
[
    'measure' => [
        'class'         => 'skeeks\cms\measure\Module',
    ]
]

```

##Links
* [Web site](http://en.cms.skeeks.com)
* [Web site (rus)](http://cms.skeeks.com)
* [Author](http://skeeks.com)
* [ChangeLog](https://github.com/skeeks-cms/cms-measure/blob/master/CHANGELOG.md)


___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)

