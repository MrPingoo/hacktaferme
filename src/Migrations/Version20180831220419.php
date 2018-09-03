<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180831220419 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parcelle_culture ADD culture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcelle_culture ADD CONSTRAINT FK_E0F33A32B108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('CREATE INDEX IDX_E0F33A32B108249D ON parcelle_culture (culture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parcelle_culture DROP FOREIGN KEY FK_E0F33A32B108249D');
        $this->addSql('DROP INDEX IDX_E0F33A32B108249D ON parcelle_culture');
        $this->addSql('ALTER TABLE parcelle_culture DROP culture_id');
    }
}
