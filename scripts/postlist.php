<?php
require 'bootstrap.php';

/** @var \Service\PostManager\API\PostManagerAPI $managerAPI */
$managerAPI = $container->get(\Service\PostManager\API\PostManagerAPI::class);
print_r($managerAPI->fetchPostList());
