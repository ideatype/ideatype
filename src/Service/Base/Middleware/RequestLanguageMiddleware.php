<?php
declare(strict_types=1);

namespace Service\Base\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\Base\Service\RequestLanguageManager;

class RequestLanguageMiddleware implements MiddlewareInterface
{
    /** @var RequestLanguageManager */
    private $languageManager;

    public function __construct(RequestLanguageManager $languageManager)
    {
        $this->languageManager = $languageManager;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $langCode = $request->getAttribute("langCode", null);

        if (!empty($langCode)) {
            $this->languageManager->setRequestLanguage($langCode);
        }

        $response = $handler->handle($request);
        return $response;
    }
}
