<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721091020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_needs ADD max_temperature INT DEFAULT NULL, ADD min_humidity INT DEFAULT NULL, ADD max_humidity INT DEFAULT NULL, CHANGE target_ph target_ph INT DEFAULT NULL, CHANGE target_ec target_ec INT DEFAULT NULL, CHANGE target_temperature min_temperature INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_needs DROP max_temperature, DROP min_humidity, DROP max_humidity, CHANGE target_ph target_ph INT NOT NULL, CHANGE target_ec target_ec INT NOT NULL, CHANGE min_temperature target_temperature INT NOT NULL');
    }
}
