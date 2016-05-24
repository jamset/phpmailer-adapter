<?php
namespace PHPMailerAdapter;

use PHPMailerAdapter\Interfaces\Mail;
use PHPMailerAdapter\Inventory\Exceptions\MailerException;
use PHPMailerAdapter\Inventory\MailerConstants;
use PHPMailerAdapter\Inventory\MailerDto;

class Mailer extends \PHPMailer implements Mail
{
    /**
     * @var MailerDto
     */
    protected $mailerDto;

    public function __construct()
    {
        parent::__construct();

        $this->From = MailerConstants::DEFAULT_NOTIFIER;
        $this->FromName = MailerConstants::DEFAULT_NOTIFIER_NAME;
        $this->WordWrap = 50;

        $this->isHTML(true);
        $this->CharSet = "UTF-8";

        return null;
    }

    /**
     * @param $mailAddress
     * @return bool
     */
    public function checkEmailFormat($mailAddress)
    {
        $result = false;

        if (is_numeric($mailAddress)) {
            $result = true;
        }

        return $result;
    }

    public function send()
    {
        return parent::send();
    }

    public function addReplyTo($address, $name = '')
    {
        return parent::addReplyTo($address, $name);
    }

    public function getErrorInfo()
    {
        return $this->ErrorInfo;
    }

    public function addAddress($address, $name = NULL)
    {
        return parent::addAddress($address, $name);
    }

    public function getAllRecipientAddresses()
    {
        return parent::getAllRecipientAddresses();
    }

    public function setFrom($address, $name = '', $auto = true)
    {
        return parent::setFrom($address, $name, $auto);
    }

    public function setFromName($fromName)
    {
        $this->FromName = $fromName;
    }

    public function setSubject($subject)
    {
        $this->Subject = $subject;
    }

    public function setBody($body)
    {
        $this->Body = $body;
    }

    public function getFrom()
    {
        return $this->From;
    }

    public function getFromName()
    {
        return $this->FromName;
    }

    public function getSubject()
    {
        return $this->Subject;
    }

    public function getBody()
    {
        return $this->Body;
    }

    public function useMailgun()
    {
        $this->isSMTP();  // Set thiser to use SMTP
        $this->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
        $this->SMTPAuth = true; // Enable SMTP authentication
        $this->Username = ''; // SMTP username from https://mailgun.com/cp/domains
        $this->Password = ''; // SMTP password from https://mailgun.com/cp/domains
        $this->SMTPSecure = 'tls'; // Enable encryption, 'ssl'

        return null;
    }

    /**
     * @return null
     * @throws MailerException
     */
    public function initSendingInfo()
    {
        if (!($this->mailerDto instanceof MailerDto)) {
            throw new MailerException("MailerDto wasn't set.");
        }

        foreach ($this->mailerDto->getFrom() as $fromAddress => $fromName) {
            if ($this->checkEmailFormat($fromAddress)) {
                throw new MailerException(MailerConstants::INCORRECT_MAIL_ADDRESS_FORMAT);
            }
            $this->setFrom($fromAddress, $fromName);

            break; //for case on incorrect (multiple) 'from' param
        }

        foreach ($this->mailerDto->getTo() as $toAddress => $toName) {
            if ($this->checkEmailFormat($toAddress)) {
                throw new MailerException(MailerConstants::INCORRECT_MAIL_ADDRESS_FORMAT);
            }
            $this->addAddress($toAddress, $toName);
        }

        foreach ($this->mailerDto->getCc() as $ccAddress => $ccName) {
            if ($this->checkEmailFormat($ccAddress)) {
                throw new MailerException(MailerConstants::INCORRECT_MAIL_ADDRESS_FORMAT);
            }
            $this->addCC($ccAddress, $ccName);
        }

        foreach ($this->mailerDto->getBcc() as $bccAddress => $bccName) {
            if ($this->checkEmailFormat($bccAddress)) {
                throw new MailerException(MailerConstants::INCORRECT_MAIL_ADDRESS_FORMAT);
            }
            $this->addBCC($bccAddress, $bccName);
        }

        $this->setSubject($this->mailerDto->getSubject());

        return null;
    }

    /**
     * @return MailerDto
     */
    public function getMailerDto()
    {
        return $this->mailerDto;
    }

    /**
     * @param MailerDto $mailerDto
     */
    public function setMailerDto(MailerDto $mailerDto)
    {
        $this->mailerDto = $mailerDto;
    }
}
