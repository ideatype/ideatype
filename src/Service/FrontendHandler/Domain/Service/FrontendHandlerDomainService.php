<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateExistsQuery;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateHasFileQuery;
use Service\FrontendHandler\Domain\Query\GenerateTemplateFileResponseQuery;
use SharedLibrary\Exception\TemplateDoesNotExistException;

class FrontendHandlerDomainService
{
    /** @var array */
    private $config;

    /** @var CheckIfTemplateExistsQuery */
    private $checkIfTemplateExistsQuery;

    /** @var CheckIfTemplateHasFileQuery */
    private $checkIfTemplateHasFileQuery;

    /** @var GenerateTemplateFileResponseQuery */
    private $generateTemplateFileResponseQuery;

    public function __construct(
        array $config,
        CheckIfTemplateExistsQuery $checkIfTemplateExistsQuery,
        CheckIfTemplateHasFileQuery $checkIfTemplateHasFileQuery,
        GenerateTemplateFileResponseQuery $generateTemplateFileResponseQuery
    ) {
        $this->config = $config;
        $this->checkIfTemplateExistsQuery = $checkIfTemplateExistsQuery;
        $this->checkIfTemplateHasFileQuery = $checkIfTemplateHasFileQuery;
        $this->generateTemplateFileResponseQuery = $generateTemplateFileResponseQuery;
    }

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        $template = $this->config['template'];
        if (!$this->checkIfTemplateExistsQuery->execute($template)) {
            throw TemplateDoesNotExistException::forTemplate($template);
        }

        if ($this->checkIfTemplateHasFileQuery->execute($template, $request->getUri()->getPath())) {
            return $this->generateTemplateFileResponseQuery->execute($template, $request->getUri()->getPath());
        }

        return $this->generateTemplateFileResponseQuery->execute($template, $this->config['index_file']);
    }
}
