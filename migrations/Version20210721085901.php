<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721085901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, plant_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, soil_type VARCHAR(255) NOT NULL, seeds_qty INT NOT NULL, INDEX IDX_B6A99CEBBFC546EA (plant_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_needs (id INT AUTO_INCREMENT NOT NULL, plant_type_id INT NOT NULL, light INT NOT NULL, water_per_day INT NOT NULL, culture_stage VARCHAR(255) NOT NULL, target_temperature INT NOT NULL, target_ph INT NOT NULL, target_ec INT NOT NULL, INDEX IDX_99832766BFC546EA (plant_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEBBFC546EA FOREIGN KEY (plant_type_id) REFERENCES plant_type (id)');
        $this->addSql('ALTER TABLE plant_needs ADD CONSTRAINT FK_99832766BFC546EA FOREIGN KEY (plant_type_id) REFERENCES plant_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEBBFC546EA');
        $this->addSql('ALTER TABLE plant_needs DROP FOREIGN KEY FK_99832766BFC546EA');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE plant_needs');
        $this->addSql('DROP TABLE plant_type');
    }
}
