<?php

namespace Shopware\Tests\Mink\Element\Responsive;

use Behat\Mink\Element\NodeElement;
use Shopware\Tests\Mink\Helper;

/**
 * Element: FilterGroup
 * Location: Filters in the listing
 */
class FilterGroup extends \Shopware\Tests\Mink\Element\Emotion\FilterGroup
{
    /** @var array $selector */
    protected $selector = ['css' => 'div.filter--container label.filter-panel--title'];

    /**
     * @inheritdoc
     */
    public function getCssSelectors()
    {
        return [
            'properties' => 'label ~ div.filter-panel--content'
        ];
    }

    /**
     * Sets a property, returns false, if the property doesn't exist, otherwise true on success
     * @param string $propertyName
     * @return bool
     */
    public function setProperty($propertyName)
    {
        $this->expandProperties();

        $elements = Helper::findElements($this, ['properties']);

        /** @var NodeElement $propertyContainer */
        $propertyContainer = $elements['properties'];

        if (!$propertyContainer->hasField($propertyName)) {
            return false;
        }

        $propertyContainer->checkField($propertyName);
        return true;
    }

    /**
     * Helper method to expand the properties of the group
     */
    protected function expandProperties()
    {
        $class = $this->getParent()->getParent()->getAttribute('class');

        if (strpos($class, 'is--collapsed') === false) {
            $this->click();
        }
    }
}
