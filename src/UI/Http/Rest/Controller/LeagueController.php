<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Command\League\RegisterLeagueCommand;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class LeagueController
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route(path="/api/leagues", methods={"POST"}, name="league_register")
     * @ParamConverter("command", converter="fos_rest.request_body")
     */
    public function registerLeagueAction(RegisterLeagueCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return JsonResponse::create(['result' => 'OK']);
    }
}
