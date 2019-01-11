<?php
declare(strict_types=1);

namespace Service\ContentManager\Infrastructure\Repository;


use Service\ContentManager\Domain\Exception\PageDoesNotExistException;
use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;
use Service\Parser\API\ParserAPI;
use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Entity\EntryMeta;
use Service\ContentManager\Domain\Exception\PostDoesNotExistException;
use Service\ContentManager\Infrastructure\Definition\ContentReaderGatewayInterface;
use Service\ContentManager\Infrastructure\Hydrator\EntryHydrator;
use Service\ContentManager\Infrastructure\Hydrator\EntryMetaHydrator;
use Zend\Diactoros\Stream;

class ContentReaderRepository implements ContentReaderRepositoryInterface
{
    /** @var ContentReaderGatewayInterface */
    private $contentReaderGateway;

    /** @var ParserAPI */
    private $parserAPI;

    public function __construct(
        ContentReaderGatewayInterface $postReaderGateway,
        ParserAPI $parserAPI
    ) {
        $this->contentReaderGateway = $postReaderGateway;
        $this->parserAPI = $parserAPI;
    }

    public function fetchPostList(): PostMetaCollection
    {
        $postMetaCollection = new PostMetaCollection();
        $postMetaArray = $this->contentReaderGateway->fetchPostList();

        foreach ($postMetaArray as $fileName => $postArray) {
            $parsedPost = $this->parserAPI->parseMarkdown($postArray['content']);
            $postMeta = EntryMetaHydrator::hydrateFromParsedFile(
                $fileName,
                $parsedPost,
                $postArray['date']
            );
            $postMetaCollection->append($postMeta);
        }
        $postMetaCollection->uasort(array($this, "sortMethod"));
        return $postMetaCollection;
    }

    public function fetchSinglePost(string $postId): Entry //TODO: refactor postId to VO
    {
        $postArray = $this->contentReaderGateway->fetchSinglePost($postId);

        if (!$postArray) {
            throw PostDoesNotExistException::forPostId($postId);
        }

        $parsedPost = $this->parserAPI->parseMarkdown($postArray['content']);
        $post = EntryHydrator::hydrate(
            $postId,
            $parsedPost,
            $postArray['date']
        );
        return $post;
    }

    public function fetchPage(string $pageId): Entry //TODO: refactor pageId to VO
    {
        $pageArray = $this->contentReaderGateway->fetchPage($pageId);

        if (!$pageArray) {
            throw PageDoesNotExistException::forPageId($pageId);
        }

        $parsedPost = $this->parserAPI->parseMarkdown($pageArray['content']);
        $page = EntryHydrator::hydrate(
            $pageId,
            $parsedPost,
            $pageArray['date']
        );
        return $page;
    }

    public function sortMethod(EntryMeta $a, EntryMeta $b)
    {
        return $a->getDate() < $b->getDate();
    }

    public function fetchFile(string $pageId, string $fileName, string $type): Stream
    {
        $filePath = $this->contentReaderGateway->fetchFile($pageId, $fileName, $type);
        return new Stream($filePath);
    }
}
