<?php
declare(strict_types=1);

namespace Endpoint\File\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\ConfigManager\Application\Service\ConfigManagerService;
use Service\ContentManager\API\ContentManagerAPI;
use Service\ContentManager\Domain\Exception\PageDoesNotExistException;
use Service\ContentManager\Domain\Exception\PostDoesNotExistException;
use SharedLibrary\Exception\InvalidContentTypeException;
use SharedLibrary\Response\StandardResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class GetFileAction implements RequestHandlerInterface
{
    /** @var ContentManagerAPI */
    private $postManagerAPI;

    public function __construct(ContentManagerAPI $contentManagerAPI)
    {
        $this->postManagerAPI = $contentManagerAPI;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $type = $request->getAttribute("type");
        $id = $request->getAttribute("id");
        $fileName = $request->getAttribute("fileName");

        if (empty($id)) {
            return new StandardResponse(['message' => "Page ID missing"], false);
        }

        switch ($type) {
            case 'post':
                $stream = $this->postManagerAPI->fetchFileForPost($id, $fileName);
                break;
            case 'page':
                $stream = $this->postManagerAPI->fetchFileForPage($id, $fileName);
                break;
            default:
                return new StandardResponse(['message' => "Content type {$type} is invalid"], false);
                break;
        }

//        try {
//            $stream = $this->postManagerAPI->fetchFileForPost($pageId, $fileName);
//        } catch (PageDoesNotExistException $e) {
//            return new StandardResponse(
//                [
//                    'message' => $e->getMessage()
//                ],
//                false,
//                $e->getCode()
//            );
//        }

        return new HtmlResponse(
            $stream,
            200,
            [
                'Content-Type' => 'image/jpeg',//(new \finfo(FILEINFO_MIME))->file($file),
                'Content-Disposition' => 'attachment; filename=' . basename($fileName),
                'Content-Transfer-Encoding' => 'Binary',
                'Pragma' => 'public',
                'Expires' => '0',
                'Cache-Control' => 'must-revalidate',
                'Content-Length' => "{$stream->getSize()}",
            ]
        );
    }
}
