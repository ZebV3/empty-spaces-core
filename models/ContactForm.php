<?php
namespace app\models;

use app\core\Application;
use app\core\Model;

/**
 * Class LoginForm
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\models
 */

class ContactForm extends Model
{
    protected string $checkbox = 'query_type[]';
    public string $email = '';
    public string $subject = '';
    public string $query_type = '';
    public string $message = '';
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'query_type' => [self::RULE_REQUIRED],
            'subject' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Recipient Email Address',
            'query_type' => 'Choose the type of query',
            'subject' => 'Subject',
            'message' => 'Message'
        ];
    }

    public function send($body)
    {
        return mail('shahzaibhassan1578.dev@gmail.com', $body['subject'], $body['message']);
    }
}