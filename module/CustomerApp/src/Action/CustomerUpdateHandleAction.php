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
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class CustomerUpdateHandleAction
 *
 * @package CustomerApp\Action
 */
class CustomerUpdateHandleAction implements MiddlewareInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * CustomerUpdateHandleAction constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param RouterInterface             $router
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository, RouterInterface $router
    ) {
        $this->customerRepository = $customerRepository;
        $this->router             = $router;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to update the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return RedirectResponse
     */
    public function process(
        ServerRequestInterface $request, DelegateInterface $delegate
    ) {
        $id = $request->getAttribute('id');

        $updateData = $request->getParsedBody();
        $updateData['id'] = $id;

        $this->customerRepository->saveCustomer($updateData);

        return new RedirectResponse(
            $this->router->generateUri('customer-list')
        );
    }
}
