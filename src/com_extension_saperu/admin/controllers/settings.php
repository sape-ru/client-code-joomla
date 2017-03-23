<?php
defined('_JEXEC') or die('Restricted access');
class SaperuControllerSettings extends JControllerForm
{
    protected function postSaveHook(JModelLegacy $model, $validData = array())
    {

        if(isset($validData['SAPE_USER'])){

            $SID = $validData['SAPE_USER'];
            if(isset( $validData['tizer'] ) && $validData['tizer']){
                $file_name = $this->_getTizerImageOptions($validData['tizerImage']);
                if($file_name){
                    $dir = $this->_getSapePath() . DIRECTORY_SEPARATOR . 'sape.php';
                    $data = sprintf('<?php define(\'_SAPE_USER\', \'%s\');require_once(\'%s\');$sape = new SAPE_client(array(\'charset\' => \'UTF-8\'));$sape->show_image();', $SID, $dir);
                    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/'.$file_name, $data);
                }
            }

            if(isset( $validData['articles'] ) && $validData['articles']){
                $dir = $this->_getSapePath() . DIRECTORY_SEPARATOR . 'sape.php';
                $data = sprintf('<?php define(\'_SAPE_USER\', \'%s\');require_once(\'%s\');$sape = new SAPE_articles();echo $sape->process_request();', $SID, $dir);
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/'.$SID.'.php', $data);
            }
        }

    }

    protected function _getSapePath()
    {
        return (defined('JPATH_LIBRARIES') ? JPATH_LIBRARIES : JPATH_ROOT . '/libraries') . DIRECTORY_SEPARATOR . 'sape';
    }

    protected function _getTizerImageOptions($id = null)
    {
        if($id != null){
            $data = $this->_getTizerImageOptions();
            return isset($data[$id])?$data[$id]:null;
        }
        return array('img.php', 'image.php', 'photo.php', 'wp-img.php', 'wp-image.php', 'wp-photo.php');
    }

}