<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Command\Team\RegisterTeamCommand;
use App\Application\Query\Team\FindByUuidQuery;
use App\Application\Query\Team\GetAllQuery;
use Assert\Assertion;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TeamController
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
     * @Route(path="/api/teams", methods={"POST"}, name="api_team_register")
     */
    public function registerTeamAction(Request $request): JsonResponse
    {
        Assertion::uuid($uuid = $request->get('uuid'));
        Assertion::notBlank($name = $request->get('name'));
        Assertion::notBlank($country = $request->get('country'));

        $this->commandBus->handle(new RegisterTeamCommand(
            $uuid,
            $name,
            $country
        ));

        return JsonResponse::create(
            $this->queryBus->handle(new FindByUuidQuery($uuid))
        );
    }

    /**
     * @Route(path="/api/teams/{uuid}", methods={"GET"}, name="api_team_find_one_by_uuid")
     */
    public function findOneTeamByUuidAction(Request $request): JsonResponse
    {
        Assertion::uuid($uuid = $request->get('uuid'));

        return JsonResponse::create(
            $this->queryBus->handle(new FindByUuidQuery($uuid))
        );
    }

    /**
     * @Route(path="/api/teams", methods={"GET"}, name="api_get_all")
     */
    public function getAllAction(Request $request): JsonResponse
    {
        return JsonResponse::create(
            $this->queryBus->handle(new GetAllQuery())
        );
    }
}
