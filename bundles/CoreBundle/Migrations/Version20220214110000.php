<?php

declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220214110000 extends AbstractMigration
{
    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Add storageType column to database';
    }

    public function up(Schema $schema): void
    {
        if ($schema->getTable('versions')->hasColumn('storageType') === false) {
            $this->addSql("ALTER TABLE `versions` ADD COLUMN `storageType` varchar(5) DEFAULT NULL;");
            $this->addSql("update `versions` set storageType = 'fs'");
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->getTable('versions')->hasColumn('storageType')) {
            $this->addSql('ALTER TABLE `versions` DROP COLUMN `storageType`;');
        }
    }
}
