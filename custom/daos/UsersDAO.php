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
 * @date   June 20, 2009
 */

class UsersDAO extends SqliteDAO {

    var $data;
    var $source;

    function __construct() {
        parent::__construct(array(
            'type'          => 'users', 
            'data_sub_path' => 'users/',
            'bean_class'    => 'User'
        ));
    }
    
    function getByKey($key, $value) {
        $Use = null;
        $result = parent::getByKey($key, $value);
        if (is_array($result)) {
            $User = $result[0];
        }
        else {
            $User = $result;
        }
        return $User;
    }
    
    /**
     * Updates the last login of the User
     * @param User $User  The User object to update
     * @return boolean
     * @throws Exception 
     */
    function updateLastLogin($User) {
        $result = false;
        try {
            $sql    = "UPDATE User SET lastlogin = :lastlogin WHERE id = :id";
            $sth    = $this->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $result = $sth->execute(array(':lastlogin' => time(), ':id' => $User->getId()));
        }
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $result;
    }
}