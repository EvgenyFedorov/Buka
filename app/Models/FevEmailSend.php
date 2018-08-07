<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mail;

Class FevEmailSend extends model{

    public $data_email         = array();
    public $tmp_email          = null;
    public $email_title        = null;
    public $email_subject      = null;
    public $email_address_to   = null;
    public $email_address_from = "rsa-team@yandex.ru";

    public function runRegistrationSendEmail(){

        Mail::send($this->tmp_email, ['confirm_code' => $this->data_email['confirm_link']], function ($message) {
            $message->from($this->email_address_from, $this->email_title);
            $message->to($this->email_address_to, $this->email_title);
        });

    }
    public function runConfirmSendEmail(){

        Mail::send($this->tmp_email, ['email' => $this->data_email['email'], 'password' => $this->data_email['password']], function ($message) {
            $message->from($this->email_address_from, $this->email_title);
            $message->to($this->email_address_to, $this->email_title);
        });

    }
    public function sendEmailRobokassa(){

        Mail::send($this->tmp_email, $this->data_email, function ($message) {
            $message->from($this->email_address_from, $this->email_title);
            $message->to($this->email_address_to, $this->email_title)->subject($this->email_subject);
        });

    }
    public function sendEmailUser(){

        Mail::send($this->tmp_email, $this->data_email, function ($message) {
            $message->from($this->email_address_from, $this->email_title);
            $message->to($this->email_address_to, $this->email_title)->subject($this->email_subject);
        });

    }
    public function sendEmailAdmin(){

        Mail::send($this->tmp_email, $this->data_email, function ($message) {
            $message->from($this->email_address_from, $this->email_title);
            $message->to($this->email_address_to, $this->email_title)->subject($this->email_subject);
        });

    }

}