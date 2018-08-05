<?php

namespace zhangjian180\carousel;

use Yii;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Html;

/**
 * 支持单个或多个（列表）多图轮播展示小部件
 *
 * ```php
 * echo Carousel::widget([
 *     'imagesData' => ['http://...01.png', 'http://...02.png'],
 *     'imagesConfig' => [
 *         'width' => '104',
 *         'height' => '40'
 *     ],
 *     'defaultDataSrc' => 'holder.js/104x40',
 *     'myCarouselIdName' => 'myCarousel',
 *     'myCarouselStyle' => 'width:104px !important; margin:0 auto;'
 *   ]);
 * ```
 *
 * @author Zhang Jian <435222656@qq.com>
 * @version 1.0
 */
class Carousel extends Widget
{
    /**
     * @var bool 是否展示默认图
     */
    public $isShowDefaultImg = true;

    /**
     * @var bool 是否展示左右控制键
     */
    public $isShowControl = true;

    /**
     * @var integer 轮播速度
     */
    public $interval = 3000;

    /**
     * @var array 图片数据
     */
    public $imagesData = [];

    /**
     * @var array 图片参数
     */
    public $imagesConfig = [
        'width' => '100',
        'height' => '50'
    ];

    /**
     * @var string 默认图参数
     */
    public $defaultDataSrc = 'holder.js/50x50';

    /**
     * @var string 列表区分重复ID
     */
    public $myCarouselIdName = 'myCarousel';

    /**
     * @var string 定制banner盒子样式
     */
    public $myCarouselStyle = '';

    /**
     * 初始化数据
     */
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->registerJs();
        echo $this->setHtml();
    }

    /**
     * 设置视图
     */
    public function setHtml()
    {
        $html = '';
        if ($this->imagesData) {
            $imgHtml = $controlHtml = '';
            foreach ($this->imagesData as $key => $val) {
                $imgHtml .= Html::tag('div', Html::a(Html::img($val,
                    array_merge(['alt' => 'First slide', 'class' => 'img-thumbnail'], $this->imagesConfig)),
                    $val, ['target' => '_blank']), ['class' => 'item ' . ($key == 0 ? 'active' : '')]);
            }

            $this->isShowControl === true && $controlHtml = <<<HTML
                <a class="left carousel-control" href="#{$this->myCarouselIdName}" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#{$this->myCarouselIdName}" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
HTML;
            $html = Html::tag('div', Html::tag('div', $imgHtml, ['class' => 'carousel-inner']) . $controlHtml
                , ['id' => $this->myCarouselIdName, 'class' => 'carousel slide', 'style' => $this->myCarouselStyle]);
        } elseif ($this->isShowDefaultImg === true) {
            $html = Html::tag('img', '', ['class' => 'img-thumbnail', 'data-src' => $this->defaultDataSrc]);
        }
        return $html;
    }

    public function registerJs()
    {
        $js = <<<JS
        $('.carousel').carousel({
            interval: {$this->interval}
        });
JS;
        $view = $this->getView();
        $view->registerJsFile('/js/holder.min.js', ['position' => View::POS_END]);
        $view->registerJs($js);
    }
}