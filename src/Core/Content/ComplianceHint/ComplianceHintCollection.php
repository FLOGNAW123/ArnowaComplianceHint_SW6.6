<?php declare(strict_types=1);

namespace Arnowa\ComplianceHint\Core\Content\ComplianceHint;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<ComplianceHintEntity>
 */
class ComplianceHintCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ComplianceHintEntity::class;
    }
}
