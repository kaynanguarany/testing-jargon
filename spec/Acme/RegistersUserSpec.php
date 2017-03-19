<?php

namespace spec\Acme;

use Acme\RegistersUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\UserRepository;
use Acme\Mailer;

class RegistersUserSpec extends ObjectBehavior
{
    function let(UserRepository $repository, Mailer $mailer)
    {
        $this->beConstructedWith($repository, $mailer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RegistersUser::class);
    }

    function it_creates_a_new_user(UserRepository $repository)
    {
        $user = ['username' => 'john doe', 'email' => 'john@example.com'];

        $repository->create($user)->shouldBeCalled();

        $this->register($user);
    }

    function it_calls_a_welcome_emal(Mailer $mailer)
    {
        $user = ['username' => 'john doe', 'email' => 'john@example.com'];

        $mailer->sendWelcome('john@example.com')->shouldBeCalled();

        $this->register($user);
    }
}
