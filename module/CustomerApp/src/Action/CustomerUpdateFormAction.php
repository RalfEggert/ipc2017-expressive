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
use Psr\Http\Message\ResponseInterface;
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
     * @var CustomerForm
     */
    private $customerForm;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * CustomerUpdateFormAction constructor.
     *
     * @param TemplateRendererInterface   $template
     * @param CustomerForm                $customerForm
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        TemplateRendererInterface $template, CustomerForm $customerForm,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->template           = $template;
        $this->customerForm       = $customerForm;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to update the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $request, DelegateInterface $delegate
    ) {
        $id = $request->getAttribute('id');

        $customer = $this->customerRepository->getCustomerById($id);

        $this->customerForm->setData($customer);

        $data = [
            'customerForm' => $this->customerForm,
        ];

        return new HtmlResponse(
            $this->template->render('customer::update', $data)
        );
    }
}
