<?php
namespace zebv3\EmptySpacesCore\exception;

use Exception;

/**
 * Class NotFoundException
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

class NotFoundException extends Exception
{
    protected $message = 'Page Not Found';
    protected $code = 404;
}