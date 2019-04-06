<?php
declare(strict_types=1);

namespace App\UI\Http\Web\Controller;

use App\Application\Query\League\FindByUuidQuery;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class LeagueController
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
     * LeagueController constructor.
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
     * @Route(path="/leagues/{uuid}", methods={"GET"}, name="league_show_one")
     *
     * @param $uuid
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showLeagueAction($uuid): Response
    {
        $league = $this->queryBus->handle(new FindByUuidQuery($uuid));

        $content = $this->template->render('league/show.html.twig', [
            'league' => $league,
        ]);

        return new Response($content, Response::HTTP_OK);
    }
}
