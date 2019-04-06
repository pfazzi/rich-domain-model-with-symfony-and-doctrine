<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Command\League\RegisterLeagueCommand;
use App\Application\Query\League\FindByUuidQuery;
use Assert\Assertion;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class LeagueController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var CommandBus */
    private $queryBus;

    public function __construct(CommandBus $commandBus, CommandBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    /**
     * @Route(path="/api/leagues", methods={"POST"}, name="api_league_register")
     */
    public function registerLeagueAction(Request $request): JsonResponse
    {
        Assertion::uuid($uuid = $request->get('uuid'));
        Assertion::notBlank($name = $request->get('name'));

        $this->commandBus->handle(new RegisterLeagueCommand(
            $uuid,
            $name
        ));

        return JsonResponse::create(
            $this->queryBus->handle(new FindByUuidQuery($uuid))
        );
    }

    /**
     * @Route(path="/api/leagues/{uuid}", methods={"GET"}, name="api_league_find_one_by_uuid")
     */
    public function findOneLeagueByUuidAction(Request $request): JsonResponse
    {
        Assertion::uuid($uuid = $request->get('uuid'));

        return JsonResponse::create(
            $this->queryBus->handle(new FindByUuidQuery($uuid))
        );
    }
}
