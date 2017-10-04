<?php

namespace NovaTrainingBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class SportController extends Controller
{
    public function getSportsAction()
    {
        $query = new Query();

        $query->filter =
            new Criterion\LogicalAnd(array(
                    new Criterion\ContentTypeIdentifier(array('sport'))
                )
            );

        $repository = $this->getRepository();
        //$repository = $this->get('ezpublish.api.repository'); si pas controller eZ
        $searchService = $repository->getSearchService();

        $searchResult = $searchService->findContent($query);

        return $this->render('NovaTrainingBundle:full:sport.html.twig', array(
            'searchHits' => $searchResult->searchHits
        ));
    }
}
