<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Action;

use CustomerApp\Form\CustomerForm;
use CustomerDomain\Repository\CustomerRepositoryInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class CustomerCreateHandleAction
 *
 * @package CustomerApp\Action
 */
class CustomerCreateHandleAction implements MiddlewareInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * @var CustomerForm
     */
    private $customerForm;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * CustomerCreateHandleAction constructor.
     *
     * @param CustomerRepositoryInterface $repository
     * @param CustomerForm                $customerForm
     * @param RouterInterface             $router
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        CustomerForm $customerForm,
        RouterInterface $router
    ) {
        $this->repository   = $repository;
        $this->customerForm = $customerForm;
        $this->router       = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return mixed
     */
    public function process(
        ServerRequestInterface $request, DelegateInterface $delegate
    ) {
        $insertData = $request->getParsedBody();

        $this->repository->saveCustomer($insertData);

        return new RedirectResponse($this->router->generateUri('customer'));
    }
}