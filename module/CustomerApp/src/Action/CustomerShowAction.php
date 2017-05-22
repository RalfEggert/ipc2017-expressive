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
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class CustomerShowAction
 *
 * @package CustomerApp\Action
 */
class CustomerShowAction implements MiddlewareInterface
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
     * CustomerShowAction constructor.
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
        $id = $request->getAttribute('id');

        $data = [
            'customer' => $this->customerRepository->getCustomerById($id),
        ];

        return new HtmlResponse(
            $this->template->render('customer::show', $data)
        );
    }
}
