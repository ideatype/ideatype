<?php
declare(strict_types=1);

namespace Service\Base\Service;

use Service\ConfigManager\Application\Service\ConfigManagerService;

class RequestLanguageManager
{
    /** @var string */
    private $requestLanguage;

    /** @var string */
    private $defaultLanguage;

    /** @var array */
    private $availableLanguages;

    public function __construct(ConfigManagerService $configManager)
    {
        $siteConfig = $configManager->getConfig("config")->getValue();
        $this->availableLanguages = $siteConfig['ideatype']['languages']['available'];
        $this->requestLanguage = $siteConfig['ideatype']['languages']['default'];
        $this->defaultLanguage = $siteConfig['ideatype']['languages']['default'];
    }

    public function setRequestLanguage(string $langCode)
    {
        if ($this->checkIfLanguageIsAvailable($langCode)) {
            $this->requestLanguage = $langCode;
        }
    }

    private function checkIfLanguageIsAvailable(string $langCode): bool
    {
        return array_key_exists($langCode, $this->availableLanguages);
    }

    public function getRequestLanguage(): string
    {
        return $this->requestLanguage;
    }

    public function getDefaultLanguage(): string
    {
        return $this->defaultLanguage;
    }

    public function getAvailableLanguages(): array
    {
        return $this->availableLanguages;
    }
}
