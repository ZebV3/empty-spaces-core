<?php
namespace zebv3\EmptySpacesCore;

use zebv3\EmptySpacesCore\db\DbModel;

/**
 * Class UserModel
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

abstract class UserModel extends DbModel
{
    abstract public function get_display_name(): string;
}