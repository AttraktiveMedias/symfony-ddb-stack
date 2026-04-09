<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408145131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organization_conference (organization_id BINARY(16) NOT NULL, conference_id BINARY(16) NOT NULL, INDEX IDX_784EA12732C8A3DE (organization_id), INDEX IDX_784EA127604B8382 (conference_id), PRIMARY KEY (organization_id, conference_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE organization_conference ADD CONSTRAINT FK_784EA12732C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organization_conference ADD CONSTRAINT FK_784EA127604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE volunteering ADD conference_id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE volunteering ADD CONSTRAINT FK_7854E8EE604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id)');
        $this->addSql('CREATE INDEX IDX_7854E8EE604B8382 ON volunteering (conference_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organization_conference DROP FOREIGN KEY FK_784EA12732C8A3DE');
        $this->addSql('ALTER TABLE organization_conference DROP FOREIGN KEY FK_784EA127604B8382');
        $this->addSql('DROP TABLE organization_conference');
        $this->addSql('ALTER TABLE volunteering DROP FOREIGN KEY FK_7854E8EE604B8382');
        $this->addSql('DROP INDEX IDX_7854E8EE604B8382 ON volunteering');
        $this->addSql('ALTER TABLE volunteering DROP conference_id');
    }
}
