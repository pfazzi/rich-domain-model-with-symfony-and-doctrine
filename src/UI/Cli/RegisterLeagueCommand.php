<?php
declare(strict_types=1);

namespace App\UI\Cli;

use App\Application\Command\League\RegisterLeagueCommand as RegisterLeague;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RegisterLeagueCommand extends Command
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:register-league')
            ->setDescription('Given uuid and name, register a new League.')
            ->addArgument('name', InputArgument::REQUIRED, 'League name')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'League uuid')
        ;
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterLeague(
            $uuid = ($input->getArgument('uuid') ?: Uuid::uuid4()->toString()),
            $name = $input->getArgument('name')
        );

        $this->commandBus->handle($command);

        $output->writeln('<info>League registered: </info>');
        $output->writeln('');
        $output->writeln("Uuid: $uuid");
        $output->writeln("Name: $name");
    }
}
