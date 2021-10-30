<?php
namespace App\EventListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Psr\Log\LoggerInterface;
class UserAgentSubscriber implements EventSubscriberInterface
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function onKernelRequest()
    {
        $this->logger->info('I\'m logging SUPER early on the request!');
    }
    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onKernelRequest'
        ];
    }
}