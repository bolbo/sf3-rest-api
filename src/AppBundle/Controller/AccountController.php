<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\AccountType;
use AppBundle\Repository\AccountRepository;
use Business\Model\Account;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations

/**
 * Class AccountController
 * @package AppBundle\Controller
 */
class AccountController extends Controller
{
    /**
     * @Rest\View()
     */
    public function getAccountsAction()
    {
        /** @var AccountRepository $repository */
        $repository = $this->get('account.repository');
        $accounts   = $repository->findAll();

        return $accounts;
    }

    /**
     * @Rest\View()
     * @param int $accountId
     * @return \PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface|JsonResponse
     */
    public function getAccountAction(int $accountId)
    {
        /** @var AccountRepository $repository */
        $repository = $this->get('account.repository');
        $account    = $repository->find($accountId);

        if (null == $account) {
            return View::create(['message' => 'Account ' . $accountId . ' not found'], Response::HTTP_NOT_FOUND);
        }
        return $account;
    }


    /**
     * @Rest\View()
     */
    public function postAccountsAction(Request $request)
    {
        $account = new Account([]);
        $form    = $this->createForm(AccountType::class, $account);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $repository = $this->get('account.repository');
            $account    = $repository->insert(['firstname' => $account->getFirstname(), 'lastname' => $account->getLastname(), 'email' => $account->getEmail()]);
            return $account;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deleteAccountAction(Request $request, int $accountId)
    {
        $repository = $this->get('account.repository');
        $repository->delete($accountId);
    }


    /**
     * @Rest\View
     * @param int $accountId
     * @return Account
     */
    public function putAccountAction(Request $request, int $accountId)
    {
        return $this->updateAccount($request, $accountId, true);
    }

    /**
     * @Rest\View
     * @param int $accountId
     * @return Account
     */
    public function patchAccountAction(Request $request, int $accountId)
    {
        return $this->updateAccount($request, $accountId, false);
    }

    /**
     * @param Request $request
     * @param int $accountId
     * @param bool $clearMissing
     * @return Account|\PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface|\Symfony\Component\Form\Form|JsonResponse
     */
    private function updateAccount(Request $request, int $accountId, bool $clearMissing)
    {
        $repository = $this->get('account.repository');
        $element    = $repository->find($accountId);

        if (null == $element) {
            return View::create(['message' => 'Account ' . $accountId . ' not found'], Response::HTTP_NOT_FOUND);
        }

        $account = new Account(['firstname' => $element->getFirstname(), 'lastname' => $element->getLastname(), 'email' => $element->getEmail()]);
        $form    = $this->createForm(AccountType::class, $account);

        $form->submit($request->request->all(), $clearMissing); // Validation des données

        if ($form->isValid()) {
            $account = $repository->update($accountId, ['firstname' => $account->getFirstname(), 'lastname' => $account->getLastname(), 'email' => $account->getEmail()]);
            return $account;
        } else {
            return $form;
        }
    }
}
