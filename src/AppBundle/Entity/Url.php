<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Url
 *
 * @ORM\Table(name="url")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UrlRepository")
 */
class Url
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="original_url", type="text", length=255)
     */
    private $originalUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="shorten_url", type="text", length=255)
     */
    private $shortenUrl;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set originalUrl
     *
     * @param string $originalUrl
     *
     * @return Url
     */
    public function setOriginalUrl($originalUrl)
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    /**
     * Get originalUrl
     *
     * @return string
     */
    public function getOriginalUrl()
    {
        return $this->originalUrl;
    }

    /**
     * Set shortenUrl
     *
     * @param string $shortenUrl
     *
     * @return Url
     */
    public function setShortenUrl($shortenUrl)
    {
        $this->shortenUrl = $shortenUrl;

        return $this;
    }

    /**
     * Get shortenUrl
     *
     * @return string
     */
    public function getShortenUrl()
    {
        return $this->shortenUrl;
    }
}

