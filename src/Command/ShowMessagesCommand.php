<?php declare(strict_types = 1);

namespace App\Command;

use App\Entity\Message;
use App\Lib\MessageStorage;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ShowMessagesCommand extends Command
{
    protected static $defaultName = 'messages:popup';

    private SymfonyStyle $io;
    private MessageStorage $messageStorage;

    public function __construct(MessageStorage $messageStorage)
    {
        $this->messageStorage = $messageStorage;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);
        $messages = $this->messageStorage->refetch();

        foreach ($messages as $message) {
            exec("XDG_RUNTIME_DIR=/run/user/$(id -u) notify-send '{$message->getTitle()}' '{$message->getText()}'");
        }
        return Command::SUCCESS;
    }
}
