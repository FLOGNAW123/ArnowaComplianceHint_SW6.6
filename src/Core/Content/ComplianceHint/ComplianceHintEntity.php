<?php declare(strict_types=1);

namespace Arnowa\ComplianceHint\Core\Content\ComplianceHint;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ComplianceHintEntity extends Entity
{
    use EntityIdTrait;

    protected string $productId;

    protected string $productVersionId;

    protected bool $hintRequired = false;

    protected ?string $hintText = null;

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductVersionId(): string
    {
        return $this->productVersionId;
    }

    public function setProductVersionId(string $productVersionId): void
    {
        $this->productVersionId = $productVersionId;
    }

    public function isHintRequired(): bool
    {
        return $this->hintRequired;
    }

    public function setHintRequired(bool $hintRequired): void
    {
        $this->hintRequired = $hintRequired;
    }

    public function getHintText(): ?string
    {
        return $this->hintText;
    }

    public function setHintText(?string $hintText): void
    {
        $this->hintText = $hintText;
    }
}
