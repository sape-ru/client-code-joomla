<?php
defined('_JEXEC') or die;

class SaperuHelper  extends JHelperContent
{

    public static $_sape_client = null;
    public static $_sape_client_articles = null;
    public static $_sape_client_context = null;

    protected static function _getSapePath()
    {
        return (defined('JPATH_LIBRARIES') ? JPATH_LIBRARIES : JPATH_ROOT . '/libraries') . DIRECTORY_SEPARATOR . 'sape';
    }

    public static function getSapeSettings()
    {

        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_saperu/models/', 'SettingsModel');
        JModelLegacy::addTablePath(JPATH_ADMINISTRATOR . '/components/com_saperu/tables/', 'SettingsTable');

        $model = JModelLegacy::getInstance('Settings', 'SaperuModel', array('ignore_request' => true));
        $item = $model->getItem(1);

        if(!$item){
            return false;
        }

        return $item;
        //return SaperuModelSettings::getInstance('Settings', 'SaperuModel')->getItem(1);
    }


    private static function _sape_return_links( $count, $options ) {
        return self::_getSapeClient()->return_links( $count, $options );
    }
    private static function _getSapeClient() {
        if ( self::$_sape_client === null ) {
            include_once self::_getSapePath() . DIRECTORY_SEPARATOR . 'sape.php';
            self::$_sape_client = new SAPE_client( self::getSapeOptions() );
        }

        return self::$_sape_client;
    }

    private static function _getSapeArticles(){

        if ( self::$_sape_client_articles === null ) {
            include_once self::_getSapePath() . DIRECTORY_SEPARATOR . 'sape.php';
            self::$_sape_client_articles = new SAPE_articles( self::getSapeOptions() );
        }

        return self::$_sape_client_articles;
    }

    private static function _getSapeContext()
    {
        if ( self::$_sape_client_context === null ) {
            include_once self::_getSapePath() . DIRECTORY_SEPARATOR . 'sape.php';
            self::$_sape_client_context = new SAPE_context( self::getSapeOptions() );
        }

        return self::$_sape_client_context;
    }

    public static function getLinks($count, $options)
    {
        if(!defined('_SAPE_USER') || !defined('_SAPE_LINKS')){


            $SS = self::getSapeSettings();


            if(!$SS){
                return false;
            }

            if(!defined('_SAPE_USER')) {
                define('_SAPE_USER', $SS->SAPE_USER);
            }
            define('_SAPE_LINKS', $SS->links);
        }

        if(defined('_SAPE_USER') && _SAPE_LINKS) {
            return self::_sape_return_links($count, $options);
        }


        return false;
    }

    public static function getTizerBlock($ID)
    {
        return self::_getSapeClient()->return_teasers_block( (int)$ID );
    }

    public static function getSapeOptions()
    {

        self::initSape();

        return array(
            'charset'                 => 'UTF-8',
            'multi_site'              => true,
            'show_counter_separately' => true,
            'force_show_code' => _SAPE_SFC
        );
    }

    public static function getArticlesBlock($ID)
    {

        return self::_getSapeArticles()->return_announcements( $ID );
    }

    public static function getCounter()
    {
        return self::_getSapeClient()->return_counter();
    }

    public static function getContext($text)
    {
        return self::_getSapeContext()->replace_in_text_segment($text);
    }

    public static function initSape()
    {
        $SS = self::getSapeSettings();

        if(!defined('_SAPE_USER')){
            define('_SAPE_USER', $SS->SAPE_USER);

            if(!defined('_SAPE_SFC')) {
                if ($SS->force_show_code) {
                    define('_SAPE_SFC', true);
                } else {
                    define('_SAPE_SFC', false);
                }
            }
        }

        if(!defined('_SAPE_CODE_INITIAL')){
            define('_SAPE_CODE_INITIAL', true);
            if (defined('_SAPE_USER') && ($SS->RTB || $SS->tizer)) {
                $document = JFactory::getDocument();
                $document->addCustomTag(SaperuHelper::getTizerBlock(0));
                $document->addCustomTag(SaperuHelper::getCounter());
            } elseif (defined('_SAPE_USER')) {
                $document = JFactory::getDocument();
                $document->addCustomTag(SaperuHelper::getCounter());
            }
            if($SS->context){
                define('_SAPE_CONTEXT', true);
            }


        }
    }
}
