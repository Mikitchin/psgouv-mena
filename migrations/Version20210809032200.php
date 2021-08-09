<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210809032200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, structures_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) NOT NULL, situation_matrimoniale VARCHAR(255) DEFAULT NULL, nom_pere VARCHAR(255) NOT NULL, prenom_pere VARCHAR(255) NOT NULL, nom_mere VARCHAR(255) NOT NULL, prenom_mere VARCHAR(255) NOT NULL, emploi VARCHAR(255) NOT NULL, discipline VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_268B9C9D67B3B43D (users_id), INDEX IDX_268B9C9D9D3ED38D (structures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drena (id INT AUTO_INCREMENT NOT NULL, code_drena INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, drena_id INT DEFAULT NULL, code_structure INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_6F0137EA2ED56BAB (drena_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D9D3ED38D FOREIGN KEY (structures_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA2ED56BAB FOREIGN KEY (drena_id) REFERENCES drena (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA2ED56BAB');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D9D3ED38D');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE drena');
        $this->addSql('DROP TABLE structure');
    }
}
