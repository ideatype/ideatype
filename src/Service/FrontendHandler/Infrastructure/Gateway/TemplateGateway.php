<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Infrastructure\Gateway;

use Service\FrontendHandler\Infrastructure\Definition\TemplateGatewayInterface;

class TemplateGateway implements TemplateGatewayInterface
{
    public function checkIfTemplateExists(string $templateName): bool
    {
        return is_dir($this->getTemplateDirectory() . '/' . $templateName . '/build');
    }

    private function getTemplateDirectory(): string
    {
        return realpath('templates/');
    }

    public function checkIfTemplateHasFile(string $templateName, string $fileName): bool
    {
        return file_exists(
            $this->getFilePath($templateName, $fileName)
        );
    }

    public function fetchTemplateFileContent(string $templateName, string $fileName): string
    {
        return file_get_contents(
            $this->getFilePath($templateName, $fileName)
        );
    }

    public function fetchMimeTypeForFile(string $templateName, string $fileName): string
    {

        return \League\Flysystem\Util\MimeType::detectByFilename($fileName);
    }

    private function getFilePath(string $templateName, string $fileName): string
    {
        return sprintf(
            "%s/%s/build/%s",
            $this->getTemplateDirectory(),
            $templateName,
            $fileName
        );
    }
}
