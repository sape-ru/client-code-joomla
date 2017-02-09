<?php
// no direct access
defined('_JEXEC') or die;



// Include the banners functions only once
JLoader::register('SaperuHelper', JPATH_ADMINISTRATOR . '/components/com_saperu/helpers/sape.php');

$altText = trim($params->get('content'));

$count = (int) $params->get('count');

$links = SaperuHelper::getTizerBlock((int) $params->get('count'));

require JModuleHelper::getLayoutPath('mod_saperu_tizer', $params->get('layout', 'default'));
