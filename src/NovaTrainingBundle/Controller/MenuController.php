<?php

namespace NovaTrainingBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function getMenuAction()
    {
        $response = new Response();
        $response->setMaxAge(3600);
        $response->setSharedMaxAge(84000);

        $response->headers->set('X-Location-Id', 2);
        $response->setVary('X-User-Hash');



        $query = new LocationQuery();

        $query->filter =
            new Criterion\LogicalAnd(array(
                    new Criterion\ParentLocationId(2),
                    new Criterion\ContentTypeIdentifier(array('folder', 'page_simple'))
            )

            );

        $repository = $this->getRepository();
        //$repository = $this->get('ezpublish.api.repository'); si pas controller eZ
        $searchService = $repository->getSearchService();

        $searchResult = $searchService->findLocations($query);


        return $this->render('NovaTrainingBundle::menu.html.twig', array(
            'searchHits' => $searchResult->searchHits
        ), $response);
    }
}
