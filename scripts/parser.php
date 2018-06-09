<?php
require 'bootstrap.php';

/** @var \Service\Parser\API\ParserAPI $parserAPI */
$parserAPI = $container->get(\Service\Parser\API\ParserAPI::class);
var_dump($parserAPI->parseMarkdown(<<<EOF
---
title: Tytuł xD artykuł
---
This is **strong**.
EOF
));
