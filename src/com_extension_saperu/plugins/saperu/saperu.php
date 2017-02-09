<?php
// no direct access
defined( '_JEXEC' ) or die;

require_once(JPATH_ADMINISTRATOR.'/components/com_saperu/models/settings.php');
require_once(JPATH_ADMINISTRATOR.'/components/com_saperu/tables/settings.php');

class plgContentSaperu extends JPlugin
{
    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

        $enable_plg = 0;
        if (JFactory::getApplication()->input->Get('option') == 'com_content' and
            JFactory::getApplication()->input->Get('view') == 'article' and
            JFactory::getApplication()->input->Get('id')) {
            $enable_plg = 1;
        }



        JLoader::register('SaperuHelper', JPATH_ADMINISTRATOR . '/components/com_saperu/helpers/sape.php');
        SaperuHelper::initSape();


        if ($enable_plg && defined('_SAPE_USER') && defined('_SAPE_CONTEXT') ) {
            $article->text = SaperuHelper::getContext($article->text);
        }

        return true;
    }

}
?>