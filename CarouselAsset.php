<?php

namespace zhangjian180\carousel;

use yii\web\AssetBundle;

/**
 * 轮播前端资源包
 *
 * @author Zhang Jian <435222656@qq.com>
 * @since v1.0
 */
class CarouselAsset extends AssetBundle {

    public $js = [
        'carousel.js',
        'holder.min.js'
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
