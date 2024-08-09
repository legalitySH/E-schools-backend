<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240809111729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UC_SENDER_PHONE_NUMBER ON application_sender_details (phone_number)');
        $this->addSql('CREATE UNIQUE INDEX UC_DIRECTOR_EMAIL ON directors_details (email)');
        $this->addSql('CREATE UNIQUE INDEX UC_DIRECTOR_PHONE_NUMBER ON directors_details (phone_number)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UC_SENDER_PHONE_NUMBER');
        $this->addSql('DROP INDEX UC_DIRECTOR_EMAIL');
        $this->addSql('DROP INDEX UC_DIRECTOR_PHONE_NUMBER');
    }
}
