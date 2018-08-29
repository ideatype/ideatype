<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Query;

use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;

class CheckIfTemplateHasFileQuery
{
    /** @var TemplateRepositoryInterface */
    private $templateRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository
    ) {
        $this->templateRepository = $templateRepository;
    }

    public function execute(string $templateName, string $fileName): bool
    {
        return $this->templateRepository->checkIfTemplateHasFile($templateName, $fileName);
    }
}
