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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerCreateAction implements MiddlewareInterface
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
     * @var RouterInterface
     */
    private $router;

    /**
     * CustomerShowAction constructor.
     *
     * @param TemplateRendererInterface   $template
     * @param CustomerRepositoryInterface $repository
     * @param RouterInterface             $router
     */
    public function __construct(
        TemplateRendererInterface $template,
        CustomerRepositoryInterface $repository,
        RouterInterface $router
    ) {
        $this->template   = $template;
        $this->repository = $repository;
        $this->router     = $router;
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
        $insertData = [
            'date'       => '2017-05-21 00:00:00',
            'status'     => 'new',
            'first_name' => 'Ralf',
            'last_name'  => 'Eggert',
            'country'    => 'de',
            'email'      => 'ralf@travello.de',
            'password'   => '$2y$10$HyizHhdxyOL/3ymghfdCNui7CBuhDyL1aIzKJbgLcg9HEQsvhQuma',
        ];

        $this->repository->saveCustomer($insertData);

        return new RedirectResponse($this->router->generateUri('customer'));
    }
}