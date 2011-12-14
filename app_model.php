<?php
/* SVN FILE: $Id: app_model.php 7945 2008-12-19 02:16:01Z gwoo $ */

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {

// in either your app_model.php or a model class
    function alnumWhitelist($data, $whitelist = array()) {
        $data = array_values($data);
        $check = $data[0];
        $whitelist = implode($whitelist);
        $rule = "/^[\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}{$whitelist}]+$/mu";

        return preg_match($rule, $check);
    }
	
	function afterSave() {
        $rssBuilder = $this->requestAction(array('controller' => 'casts', 'action' => 'rss'), array('return'));
        $fileName = WWW_ROOT . 'archive' . DS . 'iTunes.xml';
        $rssFile = fopen($fileName, 'w');
        fwrite($rssFile,$rssBuilder);
        fclose($rssFile);
    }
	
	function afterDelete() {
        $rssBuilder = $this->requestAction(array('controller' => 'casts', 'action' => 'rss'), array('return'));
        $fileName = WWW_ROOT . 'archive' . DS . 'iTunes.xml';
        $rssFile = fopen($fileName, 'w');
        fwrite($rssFile,$rssBuilder);
        fclose($rssFile);
    }
}
?>