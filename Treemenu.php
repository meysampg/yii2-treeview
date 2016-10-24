<?php

namespace meysampg\treeview;

use yii\bootstrap\Dropdown as BootstrapDropdown;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Treemenu extends BootstrapDropdown
{
    public function init()
    {
        parent::init();

        Html::removeCssClass($this->options, ['widget' => 'dropdown-menu']);
        Html::addCssClass($this->options, ['widget' => 'treeview-menu']);
    }

    protected function renderItems($items, $options = [])
    {
        $lines = [];
        foreach ($items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $label = '<span>' . $label . '</span>';
            if (array_key_exists('badget', $item) && array_key_exists('text', $item['badget'])) {
                $text = $item['badget']['text'];
                $float = array_key_exists('float', $item['badget']) ? $item['badget']['float'] : 'right';
                $color = array_key_exists('color', $item['badget']) ? $item['badget']['color'] : 'bg-aqua';

                $badget = '<span class="pull-' . $float . '-container">';
                $badget .= '<small class="label pull-' . $float . ' ' . $color . '">' . $text . '</small>';
                $badget .= '</span>';

                $label .= $badget;
            }
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if (empty($item['items'])) {
                if ($url === null) {
                    $content = $label;
                    Html::addCssClass($itemOptions, ['widget' => 'dropdown-header']);
                } else {
                    $content = Html::a($label, $url, $linkOptions);
                }
            } else {
                $submenuOptions = $this->submenuOptions;
                if (isset($item['submenuOptions'])) {
                    $submenuOptions = array_merge($submenuOptions, $item['submenuOptions']);
                }
                $content = Html::a($label, $url === null ? '#' : $url, $linkOptions)
                    . $this->renderItems($item['items'], $submenuOptions);
                Html::addCssClass($itemOptions, ['widget' => 'dropdown-submenu']);
            }

            $lines[] = Html::tag('li', $content, $itemOptions);
        }

        return Html::tag('ul', implode("\n", $lines), $options);
    }
}