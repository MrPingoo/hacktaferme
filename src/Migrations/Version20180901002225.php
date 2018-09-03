<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180901002225 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_parcelle (id INT AUTO_INCREMENT NOT NULL, work_id INT DEFAULT NULL, parcelle_id INT DEFAULT NULL, surface DOUBLE PRECISION NOT NULL, INDEX IDX_10DBA6AABB3453DB (work_id), INDEX IDX_10DBA6AA4433ED66 (parcelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AABB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AA4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE work_product DROP INDEX UNIQ_681BC8F4584665A, ADD INDEX IDX_681BC8F4584665A (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_parcelle');
        $this->addSql('ALTER TABLE work_product DROP INDEX IDX_681BC8F4584665A, ADD UNIQUE INDEX UNIQ_681BC8F4584665A (product_id)');
    }
}
