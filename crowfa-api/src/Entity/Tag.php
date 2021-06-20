<?php

declare(strict_types=1);

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * Represents tag. Put clear value without '#'.
 * @example #example #php
 * @ORM\Entity()
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected int|null $tid;
    /**
     * the value of tag
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    protected string|null $value;

    /**
     * Tag constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /** gets tag id
     * @return int|null
     */
    public function getTid(): int|null
    {
        return $this->tid;
    }

    /** sets tag id
     * @param int $tid
     * @return Tag
     */
    public function setTid(int $tid): self
    {
        $this->tid = $tid;
        return $this;
    }

    /**
     * prepends hashtag and gets tag value
     * @return string|null tag value
     */
    public function getValue(): string|null
    {
        return '#' . $this->value;
    }

    /**
     * sets tag value
     * @param string $value tag value
     * @return Tag this object
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * calls getValue
     * @return string tag representation
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
