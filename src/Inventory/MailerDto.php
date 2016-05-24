<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 11.01.16
 * Time: 10:43
 */
namespace PHPMailerAdapter\Inventory;

class MailerDto
{
    /**
     * @var array
     */
    protected $from;

    /**
     * @var array
     */
    protected $to;

    /**
     * @var array
     */
    protected $cc;

    /**
     * @var array
     */
    protected $bcc;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param array $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param array $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param array $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }


}
