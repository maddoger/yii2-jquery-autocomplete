<?php

namespace maddoger\widgets;

use yii\web\AssetBundle;

class AutocompleteStyleAsset extends AssetBundle
{
    public $css = [
        'autocomplete.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}