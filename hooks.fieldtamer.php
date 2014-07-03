<?php

class Hooks_fieldtamer extends Hooks
{
	/**
	* Creates CSS tags to add to the Control Panel's head tag
	*
	* @return string
	*/
	function control_panel__add_to_head()
	{
		if (in_array(URL::getCurrent(), array('/publish', '/member'))) {
			return $this->css->link('fieldtamer.css');
		}
	}
}
