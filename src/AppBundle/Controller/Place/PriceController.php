<?php
namespace AppBundle\Controller\Place;

/**
 * PriceController.php
 *
 * PHP version 7
 *
 * LICENSE: SISMIC
 *
 * @category  CategoryName
 * @author    Laurent BOLZER <lbolzer_at_sismic.fr>
 */


use AppBundle\Form\Type\PriceType;
use AppBundle\Repository\PlaceRepository;
use Business\Model\Place;
use Business\Model\Price;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations

class PriceController extends Controller
{

    /**
     * @Rest\View(serializerGroups={"price"})
     * @Rest\Get("/places/{placeId}/prices")
     */
    public function getPricesAction(Request $request, int $placeId)
    {
        /** @var PlaceRepository $repository */
        $repository = $this->get('place.repository');
        $element    = $repository->find($placeId);

        if (null == $element) {
            return $this->placeNotFound($placeId);
        }

        $place = new Place([
            'name'    => $element->getName(),
            'address' => $element->getAddress(),
        ]);

        return $place->getPrices();
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places/{placeId}/prices")
     */
    public function postPricesAction(Request $request, int $placeId)
    {
        /** @var PlaceRepository $repository */
        $repository = $this->get('place.repository');
        $place      = $repository->find($placeId);

        if (null == $place) {
            return $this->placeNotFound($placeId);
        }

        $price = new Price([]);
        $price->setPlace($place); // Ici, le lieu est associé au prix
        $form = $this->createForm(PriceType::class, $price);

        // Le paramétre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $priceRepository = $this->get('price.repository');
            $price           = $priceRepository->insert([
                'type'     => $price->getType(),
                'value'    => $price->getValue(),
                'place_id' => $placeId
            ]);

            return $price;
        } else {
            return $form;
        }
    }

    /**
     * @param int $placeId
     * @return static
     */
    private function placeNotFound(int $placeId)
    {
        return View::create(['message' => 'Place ' . $placeId . ' not found'], Response::HTTP_NOT_FOUND);
    }
}