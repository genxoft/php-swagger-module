<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/test');

return (new PhpCsFixer\Config())
    ->setIndent('    ')
    ->setLineEnding("\n")
    ->setRules([
        '@PSR12' => true,
        'no_trailing_whitespace_in_comment' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
