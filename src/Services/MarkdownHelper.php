<?php

namespace App\Services;

use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

/**
 * Class MarkdownHelper
 *
 * Helper de funciones relacionadas con el markdown.
 */
class MarkdownHelper
{
    private $cache;
    private $markdown;

    /**
     * MarkdownHelper constructor.
     *
     * @param   MarkdownInterface $markdown
     * @param   AdapterInterface  $cache
     */
    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache)
    {
        $this->markdown = $markdown;
        $this->cache    = $cache;
    }

    /**
     * Cachea y parsea el texto solicitado.
     *
     * @param   string $source Texto de markdown a cachear.
     *
     * @return  mixed
     */
    public function parse(string $source)
    {
        $item = $this->cache->getItem('markdown_'.md5($source));

        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }
}
