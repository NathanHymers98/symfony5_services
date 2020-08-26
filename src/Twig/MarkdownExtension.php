<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MarkdownExtension extends AbstractExtension // Creating a new twig filter that will use my MarkdownHelper service class
{

    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper) // Using dependency injection so that we can use the MarkdownHelper function "parse" in this class
    {

        $this->markdownHelper = $markdownHelper;
    }
    
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('parse_markdown', [$this, 'parseMarkdown'], ['is_safe' => ['html']]), // This is the name of the twig filter and the function it will call when we use the filter
        ];
    }

    public function parseMarkdown($value) // This is the function that is called when we use the new twig filter, $value refers to the text that is being parsed.
    {
        return $this->markdownHelper->parse($value); // Using our MarkdownHelper service function parse to parse the value.
    }
}
