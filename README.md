多图轮播
====
支持单个或多个（列表）多图轮播展示小部件

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist zhangjian180/yii2-carousel "*"
```

or add

```
"zhangjian180/yii2-carousel": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \zhangjian180\carousel\Carousel::widget([
    'imagesData' => ['http://...01.png', 'http://...02.png'],
    'imagesConfig' => [
        'width' => '104',
        'height' => '40'
    ],
    /* 默认图 */
    'defaultDataSrc' => 'holder.js/104x40',
    'myCarouselIdName' => 'myCarousel',
    'myCarouselStyle' => 'width:104px !important; margin:0 auto;'
]); ?>```