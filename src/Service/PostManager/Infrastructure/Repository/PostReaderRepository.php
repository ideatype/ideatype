<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Repository;


use Service\Parser\API\ParserAPI;
use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Domain\Entity\PostMeta;
use Service\PostManager\Domain\Exception\PostDoesNotExistException;
use Service\PostManager\Infrastructure\Definition\PostReaderGatewayInterface;
use Service\PostManager\Infrastructure\Definition\PostReaderRepositoryInterface;
use Service\PostManager\Infrastructure\Hydrator\PostHydrator;
use Service\PostManager\Infrastructure\Hydrator\PostMetaHydrator;

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
            $postMeta = PostMetaHydrator::hydrateFromParsedFile(
                $fileName,
                $parsedPost,
                $postArray['date']
            );
            $postMetaCollection->append($postMeta);
        }
        $postMetaCollection->uasort(array($this, "sortMethod"));
        return $postMetaCollection;
    }

    public function fetchSinglePost(string $postId): Post //TODO: refactor postId to VO
    {
        $postArray = $this->postReaderGateway->fetchSinglePost($postId);

        if (!$postArray) {
            throw PostDoesNotExistException::forPostId($postId);
        }

        $parsedPost = $this->parserAPI->parseMarkdown($postArray['content']);
        $post = PostHydrator::hydrate(
            $postId,
            $parsedPost,
            $postArray['date']
        );
        return $post;
    }

    public function sortMethod(PostMeta $a, PostMeta $b)
    {
        return $a->getDate() < $b->getDate();
    }
}
