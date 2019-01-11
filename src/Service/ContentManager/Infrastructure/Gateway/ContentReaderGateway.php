<?php
declare(strict_types=1);

namespace Service\ContentManager\Infrastructure\Gateway;


use Service\Base\Service\RequestLanguageManager;
use Service\ConfigManager\Application\Service\ConfigManagerService;
use Service\ContentManager\Infrastructure\Definition\ContentReaderGatewayInterface;
use SharedLibrary\Exception\ContentTypeIsInvalidException;

class ContentReaderGateway implements ContentReaderGatewayInterface
{
    /** @var RequestLanguageManager */
    private $languageManager;

    /** @var ConfigManagerService */
    private $configManager;

    public function __construct(RequestLanguageManager $languageManager, ConfigManagerService $configManager)
    {
        $this->languageManager = $languageManager;
        $this->configManager = $configManager;
    }

    public function fetchSinglePost(string $postId): ?array
    {
        return $this->getPostFileContent($postId);
    }

    public function fetchPage(string $postId): ?array
    {
        return $this->getPageFileContent($postId);
    }

    public function fetchPostList(): array
    {
        $dirs = $this->listDirsInPostDirectory();
        $postDirs = $this->returnDirsWithPosts($dirs);
        $returnArray = [];

        foreach ($postDirs as $dirName) {
            $fileContent = $this->getPostFileContent($dirName);
            if (!$fileContent) {
                continue;
            }
            $returnArray[$dirName] = $fileContent;
        }

        return $returnArray;
    }

    public function fetchFile(string $contentId, string $fileName, string $type): string
    {
        switch ($type) {
            case 'post':
                $dir = $this->getPostDir();
                break;
            case 'page':
                $dir = $this->getPageDir();
                break;
            default:
                throw ContentTypeIsInvalidException::forType($type);
                break;
        }

        return sprintf("%s/%s/%s", $dir, $contentId, $fileName);
    }

    private function listDirsInPostDirectory(): array
    {
        $postPath = $this->getPostDir();
        $dir = scandir($postPath);
        $directories = [];

        foreach ($dir as $fileName) {
            if (
                is_dir(realpath($postPath . '/' . $fileName))
                && !in_array($fileName, ['.', '..'])
            ) {
                $directories[] = $fileName;
            }
        }

        return $directories;
    }

    private function returnDirsWithPosts(array $directories): array
    {
        $returnDirs = [];

        foreach ($directories as $directory) {
            if (!is_null($this->getAvailablePostLanguage($directory))) {
                $returnDirs[] = $directory;
            }
        }

        return $returnDirs;
    }

    private function getPostFileContent(string $dirName): ?array
    {
        $postLanguage = $this->getAvailablePostLanguage($dirName);

        if (is_null($postLanguage)) {
            return null;
        }

        $path = $this->getPostFilePath($dirName, $postLanguage);
        $fileContent = @file_get_contents(
            $path
        );
        $fileModifiedDate = filemtime($path);
        return [
            'content' => $fileContent,
            'date' => $fileModifiedDate
        ];
    }

    private function getPageFileContent(string $dirName): ?array
    {
        $pageLanguage = $this->getAvailablePageLanguage($dirName);

        if (is_null($pageLanguage)) {
            return null;
        }

        $path = $this->getPageFilePath($dirName, $pageLanguage);
        $fileContent = @file_get_contents(
            $path
        );
        $fileModifiedDate = filemtime($path);
        return [
            'content' => $fileContent,
            'date' => $fileModifiedDate
        ];
    }

    private function getAvailablePostLanguage(string $dirName): ?string
    {
        $requestLanguage = $this->languageManager->getRequestLanguage();
        $defaultLanguage = $this->languageManager->getDefaultLanguage();

        if ($this->isValidPostForLanguage($dirName, $requestLanguage)) {
            return $requestLanguage;
        }

        if ($this->isValidPostForLanguage($dirName, $defaultLanguage)) {
            return $defaultLanguage;
        }

        if ($this->isValidPostForLanguage($dirName, "")) {
            return "";
        }

        return null;
    }

    private function getAvailablePageLanguage(string $dirName): ?string
    {
        $requestLanguage = $this->languageManager->getRequestLanguage();
        $defaultLanguage = $this->languageManager->getDefaultLanguage();

        if ($this->isValidPageForLanguage($dirName, $requestLanguage)) {
            return $requestLanguage;
        }

        if ($this->isValidPageForLanguage($dirName, $defaultLanguage)) {
            return $defaultLanguage;
        }

        if ($this->isValidPageForLanguage($dirName, "")) {
            return "";
        }

        return null;
    }

    private function isValidPostForLanguage(string $dirName, ?string $langCode = null): bool
    {
        $postPath = $this->getPostFilePath($dirName, $langCode);

        if (!$postPath) {
            return false;
        }

        if (is_file($postPath)) {
            return true;
        }

        return false;
    }

    private function isValidPageForLanguage(string $dirName, ?string $langCode = null): bool
    {
        $pagePath = $this->getPageFilePath($dirName, $langCode);

        if (!$pagePath) {
            return false;
        }

        if (is_file($pagePath)) {
            return true;
        }

        return false;
    }

    private function getPostDir(): string
    {
        return realpath($this->configManager->getConfig("paths")->getValue()['post_dir']);
    }

    private function getPageDir(): string
    {
        return realpath($this->configManager->getConfig("paths")->getValue()['page_dir']);
    }

    private function getPostFilePath(string $dirName, string $langCode)
    {
        $langSuffix = !empty($langCode) ? "_{$langCode}" : "";
        $pagePath = realpath($this->getPostDir() . '/' . $dirName . '/post' . $langSuffix . '.md');
        return $pagePath;
    }

    private function getPageFilePath(string $dirName, string $langCode)
    {
        $langSuffix = !empty($langCode) ? "_{$langCode}" : "";
        $pagePath = ($this->getPageDir() . '/' . $dirName . '/page' . $langSuffix . '.md');
        return $pagePath;
    }
}
