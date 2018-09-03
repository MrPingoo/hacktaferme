<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180831220238 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE parcelle_culture_culture');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE parcelle_culture_culture (parcelle_culture_id INT NOT NULL, culture_id INT NOT NULL, INDEX IDX_B2C87FE240B389F1 (parcelle_culture_id), INDEX IDX_B2C87FE2B108249D (culture_id), PRIMARY KEY(parcelle_culture_id, culture_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parcelle_culture_culture ADD CONSTRAINT FK_B2C87FE240B389F1 FOREIGN KEY (parcelle_culture_id) REFERENCES parcelle_culture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcelle_culture_culture ADD CONSTRAINT FK_B2C87FE2B108249D FOREIGN KEY (culture_id) REFERENCES culture (id) ON DELETE CASCADE');
    }
}
