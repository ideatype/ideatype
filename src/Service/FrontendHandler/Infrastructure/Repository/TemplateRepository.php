<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Repository;

use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;
use Service\FrontendHandler\Infrastructure\Definition\TemplateGatewayInterface;

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
}
