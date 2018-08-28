<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Repository;

interface TemplateRepositoryInterface
{
    public function checkIfTemplateExists(string $templateName): bool;
}
