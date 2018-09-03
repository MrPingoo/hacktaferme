<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180901001519 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_parcelle');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_parcelle (work_id INT NOT NULL, parcelle_id INT NOT NULL, INDEX IDX_10DBA6AABB3453DB (work_id), INDEX IDX_10DBA6AA4433ED66 (parcelle_id), PRIMARY KEY(work_id, parcelle_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AA4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
    }
}
