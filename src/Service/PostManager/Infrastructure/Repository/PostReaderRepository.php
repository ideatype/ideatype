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

        foreach ($postMetaArray as $fileName => $post) {
            $parsedPost = $this->parserAPI->parseMarkdown($post);
            $postMeta = new PostMeta($fileName, $parsedPost->getMeta()->getValue());
            $postMetaCollection->append($postMeta);
        }
        return $postMetaCollection;
    }
}
