<?php
// no direct access
defined('_JEXEC') or die;

$links = $params->get('contents');

require JModuleHelper::getLayoutPath('mod_saperu_rtb', $params->get('layout', 'default'));
