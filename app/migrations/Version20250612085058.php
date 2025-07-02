<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612085058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE associate (id INT AUTO_INCREMENT NOT NULL, services_id INT NOT NULL, reservation_starts_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', reservation_ends_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_CCE5D25AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE offerings_services (offerings_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_257949B75A42904D (offerings_id), INDEX IDX_257949B7AEF5A6C1 (services_id), PRIMARY KEY(offerings_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE associate ADD CONSTRAINT FK_CCE5D25AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offerings_services ADD CONSTRAINT FK_257949B75A42904D FOREIGN KEY (offerings_id) REFERENCES offerings (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offerings_services ADD CONSTRAINT FK_257949B7AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings ADD users_id INT NOT NULL, ADD associate_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings ADD CONSTRAINT FK_7A853C3567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings ADD CONSTRAINT FK_7A853C352B0E8D99 FOREIGN KEY (associate_id) REFERENCES associate (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A853C3567B3B43D ON bookings (users_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A853C352B0E8D99 ON bookings (associate_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services ADD categories_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services ADD CONSTRAINT FK_7332E169A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7332E169A21214B7 ON services (categories_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C352B0E8D99
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE associate DROP FOREIGN KEY FK_CCE5D25AEF5A6C1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offerings_services DROP FOREIGN KEY FK_257949B75A42904D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offerings_services DROP FOREIGN KEY FK_257949B7AEF5A6C1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE associate
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE offerings_services
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C3567B3B43D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7A853C3567B3B43D ON bookings
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7A853C352B0E8D99 ON bookings
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings DROP users_id, DROP associate_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services DROP FOREIGN KEY FK_7332E169A21214B7
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7332E169A21214B7 ON services
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services DROP categories_id
        SQL);
    }
}
