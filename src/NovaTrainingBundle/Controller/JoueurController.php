<?php

namespace NovaTrainingBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class JoueurController extends Controller
{
    public function getPlayersAction()
    {
        $query = new Query();

        $query->filter =
            new Criterion\LogicalAnd(array(
                    new Criterion\ContentTypeIdentifier(array('Joueur'))
                )
            );

        $repository = $this->getRepository();
        //$repository = $this->get('ezpublish.api.repository'); si pas controller eZ
        $searchService = $repository->getSearchService();

        $searchResult = $searchService->findContent($query);

        return $this->render('NovaTrainingBundle:full:joueur.html.twig', array(
            'searchHits' => $searchResult->searchHits
        ));
    }
}
