<?php
declare(strict_types=1);

namespace SharedLibrary\Response;

use Zend\Diactoros\Response\JsonResponse;

class StandardResponse extends JsonResponse
{
    public function __construct(
        array $data = [],
        bool $statusOk = true,
        int $statusCode = 200
    ) {
        $data['status'] = $statusOk ? "OK" : "ERR";
        $data['t'] = time();
        parent::__construct($data, $statusCode);
    }
}
