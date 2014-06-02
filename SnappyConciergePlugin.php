<?php

namespace Craft;

class SnappyConciergePlugin extends BasePlugin
{
	public function init()
	{
		if ( craft()->request->isCpRequest() )
		{
			$settings = $this->getSettings();

			$snappy_widget_code = $settings->getAttribute('sc_widget_code');

			if ( empty($snappy_widget_code) ) {
				return;
			}

			$current_user_info = craft()->userSession->getUser();

			if ( $current_user_info )
			{
				$email = $current_user_info->email;
				$first_name = $current_user_info->firstName;
				$last_name = $current_user_info->lastName;

				$name = $first_name;
				if ( !empty($name) ) {
					$name .= " $last_name";
				}

				$name = trim($name);

				if ( !empty($name) ) {
					$snappy_widget_code = str_replace("<script", "<script data-name='$name' ", $snappy_widget_code);
				}

				if ( !empty($email) ) {
					$snappy_widget_code = str_replace("<script", "<script data-email='$email' ", $snappy_widget_code);
				}
			}
				
			craft()->templates->includeFootHtml($snappy_widget_code);
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
		return '1.1';
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

