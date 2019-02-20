<?php

namespace App\Services;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
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
    private $markdownLogger;
    private $isDebug;

    /**
     * MarkdownHelper constructor.
     *
     * @param   MarkdownInterface $markdown
     * @param   AdapterInterface  $cache
     */
    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache, LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->markdown = $markdown;
        $this->cache    = $cache;
        $this->logger   = $markdownLogger;
        $this->isDebug  = $isDebug;
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
        $this->writeLog($source);
        $item = $this->cache->getItem('markdown_'.md5($source));

        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }

    /**
     * Escribe las palabras pertinentes que aparezcan en el texto en el log.
     *
     * @param   string $source Texto
     */
    private function writeLog($source)
    {
        $wordToLog = $this->getWordsToLog($source);

        if (!empty($wordToLog)) {
            $this->logger->info('They are talking about '.$wordToLog.' again!');
        }
    }

    /**
     * Devuelve las palabras que hay que loggear.
     *
     * @param   string $source Texto.
     *
     * @return  string
     */
    private function getWordsToLog($source)
    {
        $words        = array(
            'bacon',
            'jalapeno',
        );
        $wordsChecked = '';

        if ($this->isDebug) {
            foreach ($words as $word) {
                if (stripos($source, $word) !== false) {
                    $wordsChecked .= $word.', ';
                }
            }
        }

        return $wordsChecked;
    }
}
