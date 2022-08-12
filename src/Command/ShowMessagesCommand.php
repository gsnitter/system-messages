<?php declare(strict_types = 1);

namespace App\Command;

use App\Entity\Message;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// the name of the command is what users type after "php bin/console"
class ShowMessagesCommand extends Command
{
    protected static $defaultName = 'messages:popup';
    private SymfonyStyle $io;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);

        $messages = [new Message('MVF', 'Alles gut')];
        foreach ($messages as $message) {
            exec("XDG_RUNTIME_DIR=/run/user/$(id -u) notify-send '{$message->getTitle()}' '{$message->getText()}'");
        }
        return Command::SUCCESS;
    }
}
