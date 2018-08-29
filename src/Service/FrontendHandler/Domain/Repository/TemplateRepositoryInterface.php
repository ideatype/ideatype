<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Repository;

interface TemplateRepositoryInterface
{
    public function checkIfTemplateExists(string $templateName): bool;

    public function checkIfTemplateHasFile(string $templateName, string $fileName);

    public function generateTemplateFileResponse(string $templateName, string $fileName);
}
