<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateExistsQuery;
use SharedLibrary\Exception\TemplateDoesNotExistException;

class FrontendHandlerDomainService
{
    /** @var array */
    private $config;

    /** @var CheckIfTemplateExistsQuery */
    private $checkIfTemplateExistsQuery;

    public function __construct(
        array $config,
        CheckIfTemplateExistsQuery $checkIfTemplateExistsQuery
    ) {
        $this->config = $config;
        $this->checkIfTemplateExistsQuery = $checkIfTemplateExistsQuery;
    }

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->checkIfTemplateExistsQuery->execute($this->config['template'])) {
            throw TemplateDoesNotExistException::forTemplate($this->config['template']);
        }
    }
}
