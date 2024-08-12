<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240812133048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE educational_institution ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE educational_institution ADD CONSTRAINT FK_3BE4C4C4C54C8C93 FOREIGN KEY (type_id) REFERENCES institution_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BE4C4C4C54C8C93 ON educational_institution (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UC_INSTITUTION_EMAIL ON educational_institution (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE educational_institution DROP CONSTRAINT FK_3BE4C4C4C54C8C93');
        $this->addSql('DROP INDEX UNIQ_3BE4C4C4C54C8C93');
        $this->addSql('DROP INDEX UC_INSTITUTION_EMAIL');
        $this->addSql('ALTER TABLE educational_institution DROP type_id');
    }
}
