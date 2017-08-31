<?php

namespace Tenolo\Bundle\FAQBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\EntityBundle\Entity\BaseEntity;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Enable;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Name;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\SortOrder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\DefaultRawMaterial;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\Slugify;

/**
 * Class Question
 *
 * @ORM\Entity(repositoryClass="Tenolo\Bundle\FAQBundle\Repository\QuestionRepository")
 *
 * @package Tenolo\Bundle\FAQBundle\Entity
 */
class Question extends BaseEntity implements QuestionInterface
{
    use Name;
    use Enable;
    use SortOrder;
    use Slugify;
    use DefaultRawMaterial;

    /**
     * @var CategoryInterface
     * @ORM\ManyToOne(targetEntity="Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface", inversedBy="questions")
     * @ORM\OrderBy({"rank" = "asc"})
     */
    protected $category;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $publishAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiresAt;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPublishAt(new \DateTime());
    }

    /**
     * @return CategoryInterface|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param CategoryInterface|null $category
     */
    public function setCategory(CategoryInterface $category = null)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * @param \DateTime $publishAt
     */
    public function setPublishAt(\DateTime $publishAt)
    {
        $this->publishAt = $publishAt;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * Is visible for user?
     *
     * @return boolean
     */
    public function isPublic()
    {
        if ($this->isEnable() && ($this->getPublishAt()->getTimestamp() < time()) && (!$this->getExpiresAt() || $this->getExpiresAt()->getTimestamp() > time())) {
            return true;
        }

        return false;
    }
}
