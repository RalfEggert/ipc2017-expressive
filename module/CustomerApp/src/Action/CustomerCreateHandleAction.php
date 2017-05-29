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
use CustomerDomain\InputFilter\CustomerInputFilter;
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
     * @var CustomerInputFilter
     */
    private $inputFilter;

    /**
     * CustomerCreateHandleAction constructor.
     *
     * @param CustomerRepositoryInterface $repository
     * @param CustomerForm                $customerForm
     * @param RouterInterface             $router
     * @param CustomerInputFilter         $inputFilter
     */
    public function __construct(
        CustomerRepositoryInterface $repository, CustomerForm $customerForm,
        RouterInterface $router, CustomerInputFilter $inputFilter
    ) {
        $this->repository = $repository;
        $this->customerForm = $customerForm;
        $this->router = $router;
        $this->inputFilter = $inputFilter;
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

        $this->inputFilter->setData($insertData);

        if ($this->inputFilter->isValid()) {
            $this->repository->saveCustomer($this->inputFilter->getValues());

            return new RedirectResponse($this->router->generateUri('customer'));
        }

        $this->customerForm->setData($this->inputFilter->getRawValues());
        $this->customerForm->setMessages($this->inputFilter->getMessages());

        return $delegate->process($request);
    }
}