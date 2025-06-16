<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612090806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE bookings_services (id INT AUTO_INCREMENT NOT NULL, bookings_id INT NOT NULL, services_id INT NOT NULL, reservation_starts_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', reservation_ends_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_9BA18C54AAC0EC61 (bookings_id), INDEX IDX_9BA18C54AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services ADD CONSTRAINT FK_9BA18C54AAC0EC61 FOREIGN KEY (bookings_id) REFERENCES bookings (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services ADD CONSTRAINT FK_9BA18C54AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services DROP FOREIGN KEY FK_9BA18C54AAC0EC61
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services DROP FOREIGN KEY FK_9BA18C54AEF5A6C1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE bookings_services
        SQL);
    }
}
