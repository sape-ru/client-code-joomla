<?php
defined('_JEXEC') or die('Restricted access');
class SaperuTableSettings extends JTable
{
    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct('#__saperu', 'id', $db);
    }
}