<?php declare(strict_types = 1);

namespace App\Lib\MessageCollector;

use App\Entity\Message;

interface MessageCollectorInterface
{
    /**
     * @return Message;
     * */
    public function getMessages(): array;
}
