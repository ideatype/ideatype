<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Query;

use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;

class CheckIfTemplateExistsQuery
{
    /** @var TemplateRepositoryInterface */
    private $templateRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository
    ) {
        $this->templateRepository = $templateRepository;
    }

    public function execute(string $templateName): bool
    {
        return $this->templateRepository->checkIfTemplateExists($templateName);
    }
}
