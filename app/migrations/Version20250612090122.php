<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612090122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C352B0E8D99
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE associate DROP FOREIGN KEY FK_CCE5D25AEF5A6C1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE associate
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7A853C352B0E8D99 ON bookings
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings DROP associate_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE associate (id INT AUTO_INCREMENT NOT NULL, services_id INT NOT NULL, reservation_starts_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', reservation_ends_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_CCE5D25AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE associate ADD CONSTRAINT FK_CCE5D25AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings ADD associate_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bookings ADD CONSTRAINT FK_7A853C352B0E8D99 FOREIGN KEY (associate_id) REFERENCES associate (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A853C352B0E8D99 ON bookings (associate_id)
        SQL);
    }
}
