<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\PlaceType;
use AppBundle\Repository\PlaceRepository;
use Business\Model\Place;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlaceController
 * @package AppBundle\Controller
 */
class PlaceController extends Controller
{
    /**
     * @Rest\View()
     */
    public function getPlacesAction()
    {
        /** @var PlaceRepository $repository */
        $repository = $this->get('place.repository');
        $places     = $repository->findAll();

        return $places;
    }


    /**
     * @Rest\View()
     * @param int $placeId
     * @return \PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface|JsonResponse
     */
    public function getPlaceAction(int $placeId)
    {
        /** @var PlaceRepository $repository */
        $repository = $this->get('place.repository');
        $place      = $repository->find($placeId);
        if (null == $place) {
            return View::create(['message' => 'Place ' . $placeId . ' not found'], Response::HTTP_NOT_FOUND);
        }
        return $place;
    }

    /**
     * @Rest\View()
     */
    public function postPlacesAction(Request $request)
    {
        $place = new Place([]);
        $form  = $this->createForm(PlaceType::class, $place);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $repository = $this->get('place.repository');
            $place      = $repository->insert(['name' => $place->getName(), 'address' => $place->getAddress()]);
            return $place;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deletePlaceAction(int $placeId)
    {
        $repository = $this->get('place.repository');
        $repository->delete($placeId);
    }

    /**
     * @Rest\View
     * @param int $placeId
     * @return Place
     */
    public function putPlaceAction(Request $request, int $placeId)
    {
        return $this->updatePlace($request, $placeId, true);
    }

    /**
     * @Rest\View
     * @param int $placeId
     * @return Place
     */
    public function patchPlaceAction(Request $request, int $placeId)
    {
        return $this->updatePlace($request, $placeId, false);
    }

    /**
     * @param Request $request
     * @param int $placeId
     * @param bool $clearMissing
     * @return Place|\PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface|\Symfony\Component\Form\Form|JsonResponse
     */
    private function updatePlace(Request $request, int $placeId, bool $clearMissing)
    {
        $repository = $this->get('place.repository');
        $element    = $repository->find($placeId);

        if (null == $element) {
            return View::create(['message' => 'Place ' . $placeId . ' not found'], Response::HTTP_NOT_FOUND);
        }

        $place = new Place(['name' => $element->getName(), 'address' => $element->getAddress()]);
        $form  = $this->createForm(PlaceType::class, $place);

        $form->submit($request->request->all(), $clearMissing); // Validation des données

        if ($form->isValid()) {
            $place = $repository->update($placeId, ['name' => $place->getName(), 'address' => $place->getAddress()]);
            return $place;
        } else {
            return $form;
        }
    }
}
