<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Gateway;


use Service\PostManager\Infrastructure\Definition\PostReaderGatewayInterface;

class PostReaderGateway implements PostReaderGatewayInterface
{
    public function fetchSinglePost(string $postId): ?array
    {
        return $this->getPostFileContent($postId);
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

    private function listDirsInPostDirectory(): array
    {
        $postPath = $this->getPostDir(); // TODO: move to config
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
            if ($this->isValidPost($directory)) {
                $returnDirs[] = $directory;
            }
        }

        return $returnDirs;
    }

    private function getPostFileContent(string $dirName): ?array
    {
        if (!$this->isValidPost($dirName)) {
            return null;
        }
        $path = realpath($this->getPostDir() . '/' . $dirName . '/post.md');
        $fileContent = @file_get_contents(
            $path
        );
        $fileModifiedDate = filemtime($path);
        return [
            'content' => $fileContent,
            'date' => $fileModifiedDate
        ];
    }

    private function isValidPost(string $dirName): bool
    {
        $postPath = realpath($this->getPostDir() . '/' . $dirName . '/post.md');

        if (!$postPath) {
            return false;
        }

        if (is_file($postPath)) {
            return true;
        }

        return false;
    }

    private function getPostDir(): string
    {
        return realpath('data/posts/');
    }
}
