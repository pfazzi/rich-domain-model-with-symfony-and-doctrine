<?php
declare(strict_types=1);

namespace App\UI\Cli;

use App\Application\Command\Team\RegisterTeamCommand as RegisterTeam;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RegisterTeamCommand extends Command
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
            ->setName('app:register-team')
            ->setDescription('Given uuid and name, register a new Team.')
            ->addArgument('name', InputArgument::REQUIRED, 'Team name')
            ->addArgument('country', InputArgument::REQUIRED, 'Team country')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'Team uuid')        ;
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterTeam(
            $uuid = ($input->getArgument('uuid') ?: Uuid::uuid4()->toString()),
            $name = $input->getArgument('name'),
            $input->getArgument('country')
        );

        $this->commandBus->handle($command);

        $output->writeln('<info>Team registered: </info>');
        $output->writeln('');
        $output->writeln("Uuid: $uuid");
        $output->writeln("Name: $name");
    }
}
