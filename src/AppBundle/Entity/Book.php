<?php
/**
 * This file is part of the symfony-project project
 *
 * (c) Cosmin Voicu<cosmin.voicu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 23/10/15
 * Time: 08:12
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Author", mappedBy="books")
     */
    private $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}


trait CevaTrait
{
    public function __construct()
    {
    }

    public function firstPublicMethod()
    {
    }

    public function secondPublicMethod()
    {
    }

    protected function firstProtectedMethod()
    {
    }

    protected function secondProtectedMethod()
    {
    }

    private function firstPrivateMethod()
    {
    }

    private function secondPrivateMethod()
    {
    }
}

abstract class AnotherClass
{

    public function __construct()
    {
    }

    public function firstPublicMethodAnother()
    {
    }

    public function secondPublicMethodAnother()
    {
    }

    protected function firstProtectedMethodAnother()
    {
    }

    protected function secondProtectedMethodAnother()
    {
    }

    private function firstPrivateMethodAnother()
    {
    }

    private function secondPrivateMethodAnother()
    {
    }
}