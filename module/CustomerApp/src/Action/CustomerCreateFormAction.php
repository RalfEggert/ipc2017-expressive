<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Action;

use CustomerApp\Form\CustomerForm;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class CustomerCreateFormAction
 *
 * @package CustomerApp\Action
 */
class CustomerCreateFormAction implements MiddlewareInterface
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
     * CustomerCreateFormAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param CustomerForm              $customerForm
     */
    public function __construct(
        TemplateRendererInterface $template, CustomerForm $customerForm
    ) {
        $this->template     = $template;
        $this->customerForm = $customerForm;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $request, DelegateInterface $delegate
    ) {
        $data = [
            'customerForm' => $this->customerForm,
        ];

        return new HtmlResponse(
            $this->template->render('customer::create', $data)
        );
    }
}
