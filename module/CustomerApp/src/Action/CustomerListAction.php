<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Action;

use CustomerDomain\Repository\CustomerRepositoryInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class CustomerListAction
 *
 * @package CustomerApp\Action
 */
class CustomerListAction implements ServerMiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * CustomerListAction constructor.
     *
     * @param TemplateRendererInterface   $template
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        TemplateRendererInterface $template,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->template           = $template;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return HtmlResponse
     */
    public function process(
        ServerRequestInterface $request, DelegateInterface $delegate
    ): HtmlResponse {
        $data = [
            'customerList' => $this->customerRepository->getCustomerList(),
        ];

        return new HtmlResponse(
            $this->template->render('customer::list', $data)
        );
    }
}
