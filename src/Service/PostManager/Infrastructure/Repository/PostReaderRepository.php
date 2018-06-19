<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Repository;


use Service\Parser\API\ParserAPI;
use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Entity\PostMeta;
use Service\PostManager\Infrastructure\Definition\PostReaderGatewayInterface;
use Service\PostManager\Infrastructure\Definition\PostReaderRepositoryInterface;

class PostReaderRepository implements PostReaderRepositoryInterface
{
    /** @var PostReaderGatewayInterface */
    private $postReaderGateway;

    /** @var ParserAPI */
    private $parserAPI;

    public function __construct(
        PostReaderGatewayInterface $postReaderGateway,
        ParserAPI $parserAPI
    ) {
        $this->postReaderGateway = $postReaderGateway;
        $this->parserAPI = $parserAPI;
    }

    public function fetchPostList(): PostMetaCollection
    {
        $postMetaCollection = new PostMetaCollection();
        $postMetaArray = $this->postReaderGateway->fetchPostList();

        foreach ($postMetaArray as $fileName => $postArray) {
            $parsedPost = $this->parserAPI->parseMarkdown($postArray['content']);
            $postMeta = new PostMeta(
                $fileName,
                $parsedPost->getMeta()->getValue(),
                $parsedPost->getValue(),
                $postArray['date']
            );
            $postMetaCollection->append($postMeta);
        }
        $postMetaCollection->uasort(array($this, "sortMethod"));
        return $postMetaCollection;
    }

    public function sortMethod(PostMeta $a, PostMeta $b)
    {
        return $a->getDate() < $b->getDate();
    }
}
