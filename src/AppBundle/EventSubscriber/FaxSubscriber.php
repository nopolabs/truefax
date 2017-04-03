<?php

namespace AppBundle\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\Infax;
use AppBundle\Entity\Outfax;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class FaxSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['sentFax', EventPriorities::POST_WRITE]],
            KernelEvents::VIEW => [['receivedFax', EventPriorities::POST_WRITE]],
        ];
    }

    public function sendFax(GetResponseForControllerResultEvent $event)
    {
        $fax = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$fax instanceof Outfax || Request::METHOD_POST !== $method) {
            return;
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('fax has been sent')
            ->setFrom('fax@nopolabs.com')
            ->setTo('dan@nopolabs.com')
            ->setBody(sprintf("Id: %d\nTo: %s\nText: %s\n", $fax->getId(), $fax->getNumber(), $fax->getText()));

        $this->mailer->send($message);
    }

    public function receivedFax(GetResponseForControllerResultEvent $event)
    {
        $fax = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$fax instanceof Infax || Request::METHOD_POST !== $method) {
            return;
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('fax has been received')
            ->setFrom('fax@nopolabs.com')
            ->setTo('dan@nopolabs.com')
            ->setBody(sprintf("Id: %d\nFrom: %s\nUrl: %s\n", $fax->getId(), $fax->getNumber(), $fax->getUrl()));

        $this->mailer->send($message);
    }
}
