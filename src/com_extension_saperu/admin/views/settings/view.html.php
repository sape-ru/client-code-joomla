<?php

defined('_JEXEC') or die('Restricted access');

class SaperuViewSettings extends JViewLegacy
{

    protected $form = null;

    function display($tpl = null)
    {

        $this->form = $this->get('Form');

        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        $this->setDocument();
        parent::display($tpl);
    }

    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->setTitle('Sape.ru');
        JText::script('COM_SAPE_SETTINGS_ERROR');
        JToolBarHelper::title('Sape.ru');

        JToolBarHelper::save('settings.save');
    }
}