<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ .DIRECTORY_SEPARATOR . 'src/')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        '@PSR2' => true,
    ])
    ->setFinder($finder)
;
