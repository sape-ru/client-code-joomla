<?php
defined('_JEXEC') or die('str');

jimport('joomla.filesystem.file');
// Load FOF if not already loaded
if (!defined('F0F_INCLUDED'))
{
    $paths = array(
        (defined('JPATH_LIBRARIES') ? JPATH_LIBRARIES : JPATH_ROOT . '/libraries') . '/f0f/include.php',
        __DIR__ . '/fof/include.php',
    );

    foreach ($paths as $filePath)
    {
        if (!defined('F0F_INCLUDED') && file_exists($filePath))
        {
            @include_once $filePath;
        }
    }
}


// Pre-load the installer script class from our own copy of FOF
if (!class_exists('FOFUtilsInstallscript', false))
{
    include_once __DIR__ . '/fof/utils/installscript/installscript.php';
}

// Pre-load the database schema installer class from our own copy of FOF
if (!class_exists('F0FDatabaseInstaller', false))
{
    @include_once __DIR__ . '/fof/database/installer.php';
}
// Pre-load the update utility class from our own copy of FOF
if (!class_exists('F0FUtilsUpdate', false))
{
    @include_once __DIR__ . '/fof/utils/update/update.php';
}
// Pre-load the cache cleaner utility class from our own copy of FOF
if (!class_exists('F0FUtilsCacheCleaner', false))
{
    @include_once __DIR__ . '/fof/utils/cache/cleaner.php';
}
class Com_SaperuInstallerScript extends F0FUtilsInstallscript{

    protected function _getSapePath()
    {
        return (defined('JPATH_LIBRARIES') ? JPATH_LIBRARIES : JPATH_ROOT . '/libraries') . DIRECTORY_SEPARATOR . 'sape';
    }
    /**
     * The component's name
     *
     * @var   string
     */
    protected $componentName = 'Saperu';

    /**
     * The title of the component (printed on installation and uninstallation messages)
     *
     * @var string
     */
    protected $componentTitle = 'Saperu';


    protected $minimumJoomlaVersion = '3.4.0';


    protected $removeFilesAllVersions = array(
        'files'   => array(

        ),
        'folders' => array(

        )
    );


    /**
     * The list of extra modules and plugins to install on component installation / update and remove on component
     * uninstallation.
     *
     * @var   array
     */
    protected $installation_queue = array(		// modules => { (folder) => { (module) => { (position), (published) } }* }*
        'modules' => array(
            'admin' => array(),

            'site' => array(
                'mod_saperu_articles' => array('left', 0),
                'mod_saperu_links' => array('left', 0),
                'mod_saperu_rtb' => array('left', 0),
                'mod_saperu_tizer' => array('left', 0),
            )
        ),
        'plugins' => array(
            'content' 		=>      array('saperu' => 1),
        )
    );

    protected function renderPostInstallation($status, $fofInstallationStatus, $strapperInstallationStatus, $parent)
    {
        $this->_installSape($parent);
    }

    private function _installSape($parent)
    {
        $src = $parent->getParent()->getPath('source');

        // Load dependencies
        JLoader::import('joomla.filesystem.file');
        JLoader::import('joomla.utilities.date');
        $source = $src . '/sape';

        if (!defined('JPATH_LIBRARIES'))
        {
            $target = JPATH_ROOT . '/libraries/sape';
        }
        else
        {
            $target = JPATH_LIBRARIES . '/sape';
        }
        if (!is_dir($target))
        {
            $installer = new JInstaller;
            $installedFOF = $installer->install($source);
        }

    }
}
