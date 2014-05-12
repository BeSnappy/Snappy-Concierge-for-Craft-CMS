<?php

namespace Craft;

class SnappyConciergePlugin extends BasePlugin
{
	public function init()
	{
		if ( craft()->request->isCpRequest() )
		{
			$settings = $this->getSettings();
			craft()->templates->includeFootHtml($settings->getAttribute('sc_widget_code'));
		}
	}


	public function hasCpSection()
	{
		return false;
	}


	function getName()
	{
		return Craft::t('Snappy Concierge');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Userscape, Inc.';
	}

	function getDeveloperUrl()
	{
		return 'http://besnappy.com';
	}

	protected function defineSettings()
	{
		return array(
			'sc_widget_code' => array(AttributeType::String, 'required' => true)
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('snappyconcierge/_settings', array(
			'settings' => $this->getSettings()
		));
	}

	//public function addTwigExtension() {}
}

