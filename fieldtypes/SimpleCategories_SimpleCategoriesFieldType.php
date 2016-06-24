<?php
/**
 * @author    Tim Kelty
 * @copyright Copyright (c) 2016 Tim Kelty
 * @link      http://fusionary.com/
 * @package   SimpleCategories
 * @since     1.0.0
 */

namespace Craft;

class SimpleCategories_SimpleCategoriesFieldType extends CategoriesFieldType
{
    /**
     * Returns the name of the fieldtype.
     *
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('Simple Categories');
    }

    /**
     * Returns the field's input HTML.
     *
     * @param string $name
     * @param mixed  $value
     * @return string
     */
    public function getInputHtml($name, $criteria)
    {
        craft()->templates->includeCssResource('simplecategories/css/input.css');

		// Make sure the field is set to a valid category group
		$sourceKey = $this->getSettings()->source;

		if ($sourceKey)
		{
			$source = $this->getElementType()->getSource($sourceKey, 'field');
		}

		if (empty($source))
		{
			return '<p class="error">'.Craft::t('This field is not set to a valid category group.').'</p>';
		}

        $vars = $this->getInputTemplateVariables($name, $criteria);
        $vars['values'] = $criteria->ids();
        $groupCriteria = craft()->elements->getCriteria(ElementType::Category);
        $groupCriteria->groupId = $source['criteria']['groupId'];
        $vars['elements'] = $groupCriteria;
        $vars['settings'] = $this->settings;

        return craft()->templates->render('simplecategories/input', $vars);
    }

    /**
     * @inheritDoc ISavableComponentType::getSettingsHtml()
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        return craft()->templates->render('simplecategories/settings', array(
            'allowMultipleSources'  => $this->allowMultipleSources,
            'allowLimit'            => $this->allowLimit,
            'sources'               => $this->getSourceOptions(),
            'targetLocaleFieldHtml' => $this->getTargetLocaleFieldHtml(),
            'viewModeFieldHtml'     => $this->getViewModeFieldHtml(),
            'settings'              => $this->getSettings(),
            'defaultSelectionLabel' => $this->getAddButtonLabel(),
            'type'                  => $this->getName()
        ));
    }

    protected function defineSettings()
    {
        $settings = parent::defineSettings();
        $settings['inputType'] = array(AttributeType::String, 'default' => 'checkboxes');

        return $settings;
    }
}
