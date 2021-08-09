<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210809142112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD drena_id INT DEFAULT NULL, ADD structure_id INT DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD date_naissance DATE DEFAULT NULL, ADD lieu_naisssance VARCHAR(255) DEFAULT NULL, ADD genre VARCHAR(255) DEFAULT NULL, ADD situation_matrimoniale VARCHAR(255) DEFAULT NULL, ADD emploi VARCHAR(255) DEFAULT NULL, ADD discipline VARCHAR(255) DEFAULT NULL, ADD nom_pere VARCHAR(255) DEFAULT NULL, ADD prenom_pere VARCHAR(255) DEFAULT NULL, ADD nom_mere VARCHAR(255) DEFAULT NULL, ADD prenom_mere VARCHAR(255) DEFAULT NULL, ADD diplome VARCHAR(255) DEFAULT NULL, ADD contact VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492ED56BAB FOREIGN KEY (drena_id) REFERENCES drena (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492ED56BAB ON user (drena_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492534008B ON user (structure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492ED56BAB');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492534008B');
        $this->addSql('DROP INDEX IDX_8D93D6492ED56BAB ON user');
        $this->addSql('DROP INDEX IDX_8D93D6492534008B ON user');
        $this->addSql('ALTER TABLE user DROP drena_id, DROP structure_id, DROP prenom, DROP email, DROP date_naissance, DROP lieu_naisssance, DROP genre, DROP situation_matrimoniale, DROP emploi, DROP discipline, DROP nom_pere, DROP prenom_pere, DROP nom_mere, DROP prenom_mere, DROP diplome, DROP contact');
    }
}
