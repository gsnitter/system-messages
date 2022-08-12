<?php declare(strict_types = 1);

namespace App\Lib;

use App\Entity\Message;

class MessageStorage
{
    /** \Traversable[MessageCollectorInterface] */
    private iterable $collectors;

    /** Message[] */
    private $messages = [];

    public function __construct(iterable $collectors)
    {
        assert($collectors instanceof \Traversable);
        $this->collectors = $collectors;
    }

    public function refetch(): array
    {
        $this->messages = [];

        foreach ($this->collectors as $collector) {
            $this->messages = array_merge($this->messages, $collector->getMessages());
        }

        return $this->messages;
    }
}
