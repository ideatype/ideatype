<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Gateway;

use Service\FrontendHandler\Infrastructure\Definition\TemplateGatewayInterface;

class TemplateGateway implements TemplateGatewayInterface
{
    public function checkIfTemplateExists(string $templateName): bool
    {
        return is_dir($this->getTemplateDirectory() . '/' . $templateName . '/build');
    }

    private function getTemplateDirectory(): string
    {
        return realpath('templates/');
    }
}
