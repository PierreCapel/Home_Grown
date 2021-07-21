<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721091932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_needs CHANGE target_ph target_ph DOUBLE PRECISION DEFAULT NULL, CHANGE target_ec target_ec DOUBLE PRECISION DEFAULT NULL, CHANGE max_temperature max_temperature DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_needs CHANGE target_ph target_ph INT DEFAULT NULL, CHANGE target_ec target_ec INT DEFAULT NULL, CHANGE max_temperature max_temperature INT DEFAULT NULL');
    }
}
