<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Definition;

interface TemplateGatewayInterface
{
    public function checkIfTemplateExists(string $templateName): bool;

    public function checkIfTemplateHasFile(string $templateName, string $fileName): bool;

    public function fetchTemplateFileContent(string $templateName, string $fileName): string;

    public function fetchMimeTypeForFile(string $templateName, string $fileName): string;
}
