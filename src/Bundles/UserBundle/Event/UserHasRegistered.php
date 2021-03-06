<?php

declare(strict_types=1);

namespace Bundles\UserBundle\Event;

use Bundles\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

final class UserHasRegistered extends Event
{
    public const NAME = 'user.has.registered';

    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
