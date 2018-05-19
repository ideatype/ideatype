<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', Service\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', Service\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', Service\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', Service\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', Service\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', Service\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', Service\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     Service\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    //$app->get('/', App\Handler\HomePageHandler::class, 'home');
};
