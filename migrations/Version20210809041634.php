<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210809041634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent ADD drena_id INT DEFAULT NULL, ADD diplome VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D2ED56BAB FOREIGN KEY (drena_id) REFERENCES drena (id)');
        $this->addSql('CREATE INDEX IDX_268B9C9D2ED56BAB ON agent (drena_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D2ED56BAB');
        $this->addSql('DROP INDEX IDX_268B9C9D2ED56BAB ON agent');
        $this->addSql('ALTER TABLE agent DROP drena_id, DROP diplome');
    }
}
