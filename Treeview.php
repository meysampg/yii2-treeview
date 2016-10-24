<?php

namespace meysampg\treeview;

use yii\bootstrap\Nav as BootstrapNav;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Treemenu;

class Treeview extends BootstrapNav
{
	public function init()
	{
	    parent::init();
	    
	    Html::addCssClass($this->options, ['class' => 'sidebar-menu']);
	    Html::removeCssClass($this->options, ['widget' => 'nav']);
	    $this->activateParents = true;
	}

	/**
	 * Renders a widget's item.
	 * @param string|array $item the item to render.
	 * @return string the rendering result.
	 * @throws InvalidConfigException
	 */
	public function renderItem($item)
	{
	    if (is_string($item)) {
	        return $item;
	    }
	    if (!isset($item['label'])) {
	        throw new InvalidConfigException("The 'label' option is required.");
	    }
	    $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
	    $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
	    $options = ArrayHelper::getValue($item, 'options', []);
	    $icon = ArrayHelper::getValue($item, 'icon', '');
	    $items = ArrayHelper::getValue($item, 'items');
	    $url = ArrayHelper::getValue($item, 'url', '#');
	    $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($icon)) {
            $icon = '<i class="' . $icon . '"></i>';
            $label = $icon . '<span>' . $label . '</span>';
        }

	    if (isset($item['active'])) {
	        $active = ArrayHelper::remove($item, 'active', false);
	    } else {
	        $active = $this->isItemActive($item);
	    }

	    if ($items !== null) {
	        $linkOptions['data-toggle'] = 'dropdown';
	        Html::addCssClass($options, ['widget' => 'treeview']);
	        Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
	        if ($this->dropDownCaret !== '') {
	            $label .= ' ' . $this->dropDownCaret;
	        }
	        if (is_array($items)) {
	            if ($this->activateItems) {
	                $items = $this->isChildActive($items, $active);
	            }
	            $items = $this->renderTreeMenu($items, $item);
	        }
	    }

	    if ($this->activateItems && $active) {
	        Html::addCssClass($options, 'active');
	    }

	    return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
	}

	public function renderTreeMenu($items, $parentItem)
	{
		return Treemenu::widget([
		    'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
		    'items' => $items,
		    'encodeLabels' => $this->encodeLabels,
		    'clientOptions' => false,
		    'view' => $this->getView(),
		]);
	}
}
