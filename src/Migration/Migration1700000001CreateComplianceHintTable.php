<?php declare(strict_types=1);

namespace Arnowa\ComplianceHint\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1700000001CreateComplianceHintTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1700000001;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement('
            CREATE TABLE IF NOT EXISTS `arnowa_compliance_hint` (
                `id`                 BINARY(16)  NOT NULL,
                `product_id`         BINARY(16)  NOT NULL,
                `product_version_id` BINARY(16)  NOT NULL,
                `hint_required`      TINYINT(1)  NOT NULL DEFAULT 0,
                `hint_text`          LONGTEXT    NULL,
                `created_at`         DATETIME(3) NOT NULL,
                `updated_at`         DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.arnowa_compliance_hint.product_id`
                    FOREIGN KEY (`product_id`, `product_version_id`)
                    REFERENCES `product` (`id`, `version_id`)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
