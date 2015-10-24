<?php

namespace maddoger\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * Class Autocomplete
 *
 * More info: https://github.com/devbridge/jQuery-Autocomplete
 * @package maddoger\widgets
 */
class Autocomplete extends InputWidget
{
    /**
     * @var array the options for the plugin.
     */
    public $clientOptions = [];

    /**
     * @var array of suggestions
     * ```
     * [
     *   { value: 'Andorra', data: 'AD' },
     *   // ...
     *   { value: 'Zimbabwe', data: 'ZZ' }
     * ]
     * ```
     */
    public $lookup;

    /**
     * @var string|array url for ajax response with 'query' param.
     * You can change param name using `paramName` option in clientOptions
     * Response JSON format:
     * ```
     * {
     *   // Query is not required as of version 1.2.5
     *   "query": "Unit",
     *   "suggestions": [
     *     { "value": "United Arab Emirates", "data": "AE" },
     *     { "value": "United Kingdom",       "data": "UK" },
     *     { "value": "United States",        "data": "US" }
     *   ]
     * }
     * ```
     */
    public $serviceUrl;

    /**
     * @var string
     */
    public $styleAsset = 'maddoger\widgets\AutocompleteStyleAsset';

    /**
     * Initializes the widget.
     * This method will register the bootstrap asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'form-control';
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers CKEditor JS
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        AutocompleteAsset::register($view);
        if ($this->styleAsset) {
            call_user_func([$this->styleAsset, 'register'], $view);
        }

        $clientOptions = $this->clientOptions;
        if ($this->lookup !== null) {
            $clientOptions['lookup'] = $this->lookup;
        }
        if ($this->serviceUrl) {
            $clientOptions['serviceUrl'] = Url::to($this->serviceUrl);
        }

        $jsonClientOptions = empty($clientOptions) ? '' : Json::encode($clientOptions);
        $js = "jQuery('#{$this->options['id']}').devbridgeAutocomplete({$jsonClientOptions});";
        $view->registerJs($js);
    }
}