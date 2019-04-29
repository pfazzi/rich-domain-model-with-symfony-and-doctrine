<?php
declare(strict_types=1);

namespace App\UI\Http\Web\Controller;

use App\Application\Query\Team\FindByUuidQuery;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class TeamController
{
    /**
     * @var CommandBus
     */
    private $queryBus;

    /**
     * @var Environment
     */
    private $template;

    /**
     * TeamController constructor.
     *
     * @param CommandBus  $queryBus
     * @param Environment $template
     */
    public function __construct(CommandBus $queryBus, Environment $template)
    {
        $this->queryBus = $queryBus;
        $this->template = $template;
    }

    /**
     * @Route(path="/teams/{uuid}", methods={"GET"}, name="team_show_one")
     *
     * @param $uuid
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showTeamAction($uuid): Response
    {
        $team = $this->queryBus->handle(new FindByUuidQuery($uuid));

        $content = $this->template->render('team/show.html.twig', [
            'team' => $team,
        ]);

        return new Response($content, Response::HTTP_OK);
    }
}
