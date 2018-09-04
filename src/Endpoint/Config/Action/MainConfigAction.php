<?php
declare(strict_types=1);

namespace Endpoint\Config\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\ConfigManager\Application\Service\ConfigManagerService;
use SharedLibrary\Response\StandardResponse;

class MainConfigAction implements RequestHandlerInterface
{
    /** @var ConfigManagerService */
    private $configManager;

    public function __construct(ConfigManagerService $configManager)
    {
        $this->configManager = $configManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $siteConf = $this->configManager->getConfig("config")->getValue()['ideatype'];
        $menuConf = $this->configManager->getConfig("menu")->getValue();

        return new StandardResponse([
            'config' => [
                'site' => $siteConf,
                'menu' => $menuConf
            ]
        ]);
    }
}
