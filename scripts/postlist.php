<?php
require 'bootstrap.php';

/** @var \Service\ContentManager\API\ContentManagerAPI $managerAPI */
$managerAPI = $container->get(\Service\ContentManager\API\ContentManagerAPI::class);
print_r($managerAPI->fetchPostList());
