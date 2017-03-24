<?php
defined('_JEXEC') or die('Restricted access');
$input = JFactory::getApplication()->input;
$controller = JControllerLegacy::getInstance('Saperu');
$controller->execute($input->getCmd('task'));
$controller->redirect();
