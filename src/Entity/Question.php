<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\EntityBundle\Entity\BaseEntity;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Enable;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Name;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\SortOrder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\DefaultRawMaterial;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\Slugify;

use function time;

/**
 * @ORM\Entity(repositoryClass="Tenolo\Bundle\FAQBundle\Repository\QuestionRepository")
 */
class Question extends BaseEntity implements QuestionInterface
{
    use Name;
    use Enable;
    use SortOrder;
    use Slugify;
    use DefaultRawMaterial;

    /**
     * @ORM\ManyToOne(targetEntity="Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface", inversedBy="questions")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\OrderBy({"rank" = "asc"})
     *
     * @var CategoryInterface|null
     */
    protected $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    protected $content;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     *
     * @var bool
     */
    protected $top = false;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    protected $publishAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var DateTime|null
     */
    protected $expiresAt;

    public function __construct()
    {
        parent::__construct();

        $this->setPublishAt(new DateTime());
    }

    public function getCategory(): ?CategoryInterface
    {
        return $this->category;
    }

    public function setCategory(?CategoryInterface $category = null): void
    {
        $this->category = $category;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function isTop(): bool
    {
        return $this->top;
    }

    public function setTop(bool $top): void
    {
        $this->top = $top;
    }

    public function getPublishAt(): DateTime
    {
        return $this->publishAt;
    }

    public function setPublishAt(DateTime $publishAt): void
    {
        $this->publishAt = $publishAt;
    }

    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?DateTime $expiresAt = null): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function isPublic(): bool
    {
        return $this->isEnable() &&
            ($this->getPublishAt()->getTimestamp() < time()) &&
            (
                $this->getExpiresAt() === null ||
                $this->getExpiresAt()->getTimestamp() > time()
            );
    }
}
