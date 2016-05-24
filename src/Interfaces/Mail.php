<?php
namespace PHPMailerAdapter\Interfaces;

interface Mail
{
    public function send();

    public function getErrorInfo();

    public function addAddress($address, $name = '');

    public function setFrom($address, $name = '', $auto = true);

    public function setFromName($fromName);

    public function setSubject($subject);

    public function setBody($body);

    public function getFrom();

    public function getFromName();

    public function getSubject();

    public function getBody();

    public function useMailgun();

    public function addReplyTo($address, $name = '');

    public function getAllRecipientAddresses();

} 