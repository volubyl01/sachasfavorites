<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621125341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon ADD sprite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F7C4E7E55');
        $this->addSql('DROP INDEX IDX_C4E0A61F7C4E7E55 ON team');
        $this->addSql('ALTER TABLE team ADD dresseur_id INT NOT NULL, ADD pokemons LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP dresseur_name_id, DROP dresseurname');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FA1A01CBE FOREIGN KEY (dresseur_id) REFERENCES dresseur (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FA1A01CBE ON team (dresseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP sprite');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FA1A01CBE');
        $this->addSql('DROP INDEX IDX_C4E0A61FA1A01CBE ON team');
        $this->addSql('ALTER TABLE team ADD dresseur_name_id INT DEFAULT NULL, ADD dresseurname VARCHAR(255) DEFAULT NULL, DROP dresseur_id, DROP pokemons');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F7C4E7E55 FOREIGN KEY (dresseur_name_id) REFERENCES dresseur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C4E0A61F7C4E7E55 ON team (dresseur_name_id)');
    }
}
