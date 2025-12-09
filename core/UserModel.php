<?php
namespace app\core;

use app\core\db\DbModel;

/**
 * Class UserModel
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

abstract class UserModel extends DbModel
{
    abstract public function get_display_name(): string;
}