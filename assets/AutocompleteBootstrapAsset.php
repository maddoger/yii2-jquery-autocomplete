<?php

namespace maddoger\widgets;

use yii\web\AssetBundle;

class AutocompleteAsset extends AssetBundle
{
    public $sourcePath = '@bower/devbridge-autocomplete/dist';

    public $js = [
        YII_DEBUG ? 'jquery.autocomplete.js' : 'jquery.autocomplete.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}