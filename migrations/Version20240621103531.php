<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621103531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F7C4E7E55 FOREIGN KEY (dresseur_id) REFERENCES dresseur (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F7C4E7E55 ON team (dresseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F7C4E7E55');
        $this->addSql('DROP INDEX IDX_C4E0A61F7C4E7E55 ON team');
    }
}
