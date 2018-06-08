<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 19.04.2017
 * Time: 17:52
 */
namespace App;

class Translation
{
    /**
     * @var string|array
     */
    public $source;
    /**
     * @var string|array
     */
    public $result;
    /**
     * @var array
     */
    public $language;
    /**
     * @param string|array $source   The source text
     * @param string|array $result   The translation result
     * @param string       $language Translation language
     */
    public function __construct($source, $result, $language)
    {
        $this->source = $source;
        $this->result = $result;
        $this->language = explode('-', $language);
    }
    /**
     * @return string|array The source text
     */
    public function getSource()
    {
        return $this->source;
    }
    /**
     * @return array|string The result text
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @return string The source language.
     */
    public function getSourceLanguage()
    {
        return $this->language[0];
    }
    /**
     * @return string The translation language.
     */
    public function getResultLanguage()
    {
        return $this->language[1];
    }
    /**
     * @return string The translation text.
     */
    public function __toString()
    {
        if (is_array($this->result)) {
            return join(' ', $this->result);
        }
        return (string) $this->result;
    }
}