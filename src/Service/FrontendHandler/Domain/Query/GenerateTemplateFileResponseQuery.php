<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Query;

use Psr\Http\Message\ResponseInterface;
use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;

class GenerateTemplateFileResponseQuery
{
    /** @var TemplateRepositoryInterface */
    private $templateRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository
    ) {
        $this->templateRepository = $templateRepository;
    }

    public function execute(string $templateName, string $fileName): ResponseInterface
    {
        return $this->templateRepository->generateTemplateFileResponse($templateName, $fileName);
    }
}
