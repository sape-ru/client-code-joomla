<?php
// no direct access
defined('_JEXEC') or die;



// Include the banners functions only once
JLoader::register('SaperuHelper', JPATH_ADMINISTRATOR . '/components/com_saperu/helpers/sape.php');

$altText = trim($params->get('content'));

$count = (int) $params->get('count');





$links = SaperuHelper::getLinks((int) $params->get('count'), array(
    'as_block'          => (int) $params->get('block') == 1 ? true : false,
    'block_orientation' => (int) $params->get('orientation')

));

require JModuleHelper::getLayoutPath('mod_saperu_links', $params->get('layout', 'default'));
