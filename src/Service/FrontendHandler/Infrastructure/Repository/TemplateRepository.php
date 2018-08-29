<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Repository;

use Psr\Http\Message\ResponseInterface;
use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;
use Service\FrontendHandler\Infrastructure\Definition\TemplateGatewayInterface;
use Zend\Diactoros\Response\HtmlResponse;

class TemplateRepository implements TemplateRepositoryInterface
{
    /** @var TemplateGatewayInterface */
    private $gateway;

    public function __construct(
        TemplateGatewayInterface $gateway
    ) {
        $this->gateway = $gateway;
    }

    public function checkIfTemplateExists(string $templateName): bool
    {
        return $this->gateway->checkIfTemplateExists($templateName);
    }

    public function checkIfTemplateHasFile(string $templateName, string $fileName): bool
    {
        return $this->gateway->checkIfTemplateHasFile($templateName, $fileName);
    }

    public function generateTemplateFileResponse(string $templateName, string $fileName): ResponseInterface
    {
        $content = $this->gateway->fetchTemplateFileContent($templateName, $fileName);
        $response = new HtmlResponse(
            $content,
            200,
            ['Content-Type' => $this->gateway->fetchMimeTypeForFile($templateName, $fileName)]
        );
        return $response;
    }
}
