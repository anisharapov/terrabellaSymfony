<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612115229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings CHANGE booked_at booked_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services CHANGE reservation_starts_at reservation_starts_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE reservation_ends_at reservation_ends_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories ADD manager_categories VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE last_connection_at last_connection_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings CHANGE booked_at booked_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users CHANGE created_at created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE last_connection_at last_connection_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories DROP manager_categories
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings_services CHANGE reservation_starts_at reservation_starts_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE reservation_ends_at reservation_ends_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
    }
}
