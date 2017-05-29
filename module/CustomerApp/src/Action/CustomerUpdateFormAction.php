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
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class CustomerUpdateFormAction
 *
 * @package CustomerApp\Action
 */
class CustomerUpdateFormAction implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * @var CustomerForm
     */
    private $customerForm;

    /**
     * CustomerUpdateFormAction constructor.
     *
     * @param TemplateRendererInterface   $template
     * @param CustomerRepositoryInterface $repository
     * @param CustomerForm                $customerForm
     */
    public function __construct(
        TemplateRendererInterface $template,
        CustomerRepositoryInterface $repository,
        CustomerForm $customerForm
    ) {
        $this->template     = $template;
        $this->repository   = $repository;
        $this->customerForm = $customerForm;
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
        $id = $request->getAttribute('id');

        $customer = $this->repository->getCustomerById($id);

        $this->customerForm->setData($customer);

        $data = [
            'customer'     => $customer,
            'customerForm' => $this->customerForm,
        ];

        return new HtmlResponse(
            $this->template->render('customer-app::update', $data)
        );
    }
}