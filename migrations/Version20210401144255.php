<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401144255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, `from` DATETIME NOT NULL, `to` DATETIME NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_773DE69DC3C6F69F (car_id), INDEX from_idx (`from`), INDEX to_idx (`to`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, rental_id INT DEFAULT NULL, `from` DATETIME NOT NULL, `to` DATETIME NOT NULL, INDEX IDX_1619C27DA7CF2329 (rental_id), INDEX from_idx (`from`), INDEX to_idx (`to`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3C6F69F FOREIGN KEY (car_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DA7CF2329 FOREIGN KEY (rental_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE rental');
    }
}
