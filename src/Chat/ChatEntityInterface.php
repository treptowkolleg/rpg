<?php

namespace Btinet\Rpg\Chat;

interface ChatEntityInterface
{
    public function ask(string $message, ChatEntityInterface $entity): void;
    public function reply(string $message, ChatEntityInterface $entity): void;
}