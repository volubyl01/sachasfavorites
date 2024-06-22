<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622071657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_pokemon (team_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_9DA5E1C4296CD8AE (team_id), INDEX IDX_9DA5E1C42FE71C3E (pokemon_id), PRIMARY KEY(team_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_pokemon ADD CONSTRAINT FK_9DA5E1C4296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_pokemon ADD CONSTRAINT FK_9DA5E1C42FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team DROP sprite, DROP pokemons');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_pokemon DROP FOREIGN KEY FK_9DA5E1C4296CD8AE');
        $this->addSql('ALTER TABLE team_pokemon DROP FOREIGN KEY FK_9DA5E1C42FE71C3E');
        $this->addSql('DROP TABLE team_pokemon');
        $this->addSql('ALTER TABLE team ADD sprite VARCHAR(255) NOT NULL, ADD pokemons LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}
