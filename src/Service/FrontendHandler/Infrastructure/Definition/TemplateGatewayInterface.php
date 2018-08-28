<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Definition;

interface TemplateGatewayInterface
{
    public function checkIfTemplateExists(string $templateName): bool;
}
