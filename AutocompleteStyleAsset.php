<?php

namespace maddoger\widgets;

use yii\web\AssetBundle;

class AutocompleteStyleAsset extends AssetBundle
{
    public $sourcePath = '@maddoger/yii2-jquery-autocomplete/assets';

    public $css = [
        'autocomplete.css',
    ];
}