<?php defined('SKYBLUE') or die('Bad file request');

/**
 * @version      2.0 2009-06-20 21:41:00 $
 * @package      SkyBlueCanvas
 * @copyright    Copyright (C) 2005 - 2010 Scott Edwin Lewis. All rights reserved.
 * @license      GNU/GPL, see COPYING.txt
 * SkyBlueCanvas is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYING.txt for copyright notices and details.
 */

/**
 * @author Scott Lewis
 * @date   June 27, 2009
 */

class SettingsController extends Controller {

    var $model;
    var $action;
    var $viewName;
    var $view_path;
    var $defaultViewName = 'list';

    function __construct($Request) {
        parent::__construct($Request);
        $this->setHandler('index',  'doIndex', true);
        $this->setViewPath(_SBC_SYS_ . "managers/settings/views/");
    }

    function doIndex() {
        $this->setViewName('list.php');
        $collections = $this->dao->index();
        Utils::sort($collections, 'name');
        $this->view->setData($collections);
    }

}