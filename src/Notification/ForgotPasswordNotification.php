<?php

namespace Smart\AuthenticationBundle\Notification;

use Symfony\Component\Notifier\Notification\EmailNotificationInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Notifier\Message\EmailMessage;

class ForgotPasswordNotification extends Notification implements EmailNotificationInterface
{
    /** @var array<mixed> */
    private $parameters;

    /**
     * @param array<mixed> $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        parent::__construct($parameters['subject']);
    }

    public function asEmailMessage(Recipient $recipient, string $transport = null): ?EmailMessage
    {
        $message = EmailMessage::fromNotification($this, $recipient);
        $message->getMessage()
            ->htmlTemplate(sprintf('%s/email/forgot_password.html.twig', $this->parameters['context']))
            ->context($this->parameters)
        ;

        return $message;
    }
}
