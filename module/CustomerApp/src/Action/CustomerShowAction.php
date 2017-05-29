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
    private $repository;

    /**
     * CustomerShowAction constructor.
     *
     * @param TemplateRendererInterface   $template
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(
        TemplateRendererInterface $template,
        CustomerRepositoryInterface $repository
    ) {
        $this->template   = $template;
        $this->repository = $repository;
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

        $data = [
            'customer' => $this->repository->getCustomerById($id),
        ];

        return new HtmlResponse(
            $this->template->render('customer-app::show', $data)
        );
    }
}
