<?php
declare(strict_types=1);

namespace TSwiackiewicz\AwesomeApp\Application\User\Event;

use TSwiackiewicz\AwesomeApp\DomainModel\User\{
    Event\UserRegisteredEvent, UserNotifier
};
use TSwiackiewicz\AwesomeApp\SharedKernel\User\Exception\RuntimeException;
use TSwiackiewicz\DDD\Event\{
    Event, EventHandler
};

/**
 * Class UserRegisteredEventHandler
 * @package TSwiackiewicz\AwesomeApp\Application\User\Event
 */
class UserRegisteredEventHandler implements EventHandler
{
    /**
     * @var UserNotifier
     */
    private $notifier;

    /**
     * UserRegisteredEventHandler constructor.
     * @param UserNotifier $notifier
     */
    public function __construct(UserNotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event): void
    {
        if (!$event instanceof UserRegisteredEvent) {
            throw RuntimeException::invalidHandledEventType($event, UserRegisteredEvent::class);
        }

        $this->notifier->notifyUser($event);
    }
}