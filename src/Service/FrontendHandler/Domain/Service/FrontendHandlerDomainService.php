<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Service\ConfigManager\Application\Service\ConfigManagerService;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateExistsQuery;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateHasFileQuery;
use Service\FrontendHandler\Domain\Query\GenerateTemplateFileResponseQuery;
use SharedLibrary\Exception\TemplateDoesNotExistException;

class FrontendHandlerDomainService
{
    /** @var ConfigManagerService */
    private $configManager;

    /** @var CheckIfTemplateExistsQuery */
    private $checkIfTemplateExistsQuery;

    /** @var CheckIfTemplateHasFileQuery */
    private $checkIfTemplateHasFileQuery;

    /** @var GenerateTemplateFileResponseQuery */
    private $generateTemplateFileResponseQuery;

    public function __construct(
        ConfigManagerService $configManager,
        CheckIfTemplateExistsQuery $checkIfTemplateExistsQuery,
        CheckIfTemplateHasFileQuery $checkIfTemplateHasFileQuery,
        GenerateTemplateFileResponseQuery $generateTemplateFileResponseQuery
    ) {
        $this->configManager = $configManager;
        $this->checkIfTemplateExistsQuery = $checkIfTemplateExistsQuery;
        $this->checkIfTemplateHasFileQuery = $checkIfTemplateHasFileQuery;
        $this->generateTemplateFileResponseQuery = $generateTemplateFileResponseQuery;
    }

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        $config = $this->configManager->getConfig("template")->getValue();
        $template = $config['template'];
        if (!$this->checkIfTemplateExistsQuery->execute($template)) {
            throw TemplateDoesNotExistException::forTemplate($template);
        }

        $path = $request->getUri()->getPath();
        if (
            $this->checkIfTemplateHasFileQuery->execute($template, $path)
            && $path != "/"
        ) {
            return $this->generateTemplateFileResponseQuery->execute($template, $path);
        }

        return $this->generateTemplateFileResponseQuery->execute($template, $config['index_file']);
    }
}
