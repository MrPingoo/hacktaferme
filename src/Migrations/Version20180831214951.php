<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180831214951 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, status INT NOT NULL, remarques LONGTEXT NOT NULL, id_fmis VARCHAR(255) NOT NULL, date_begin DATETIME NOT NULL, date_end DATETIME NOT NULL, INDEX IDX_534E68804584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_parcelle (work_id INT NOT NULL, parcelle_id INT NOT NULL, INDEX IDX_10DBA6AABB3453DB (work_id), INDEX IDX_10DBA6AA4433ED66 (parcelle_id), PRIMARY KEY(work_id, parcelle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FB6B6B584584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, parcelle_culture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_B6A99CEB40B389F1 (parcelle_culture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcelle (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, ilot_number VARCHAR(255) NOT NULL, title_for_exploitant VARCHAR(255) NOT NULL, surface DOUBLE PRECISION NOT NULL, id_parcelle_fmis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcelle_culture (id INT AUTO_INCREMENT NOT NULL, parcelle_id INT DEFAULT NULL, begin DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_E0F33A324433ED66 (parcelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_4B365660F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68804584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_parcelle ADD CONSTRAINT FK_10DBA6AA4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_product ADD CONSTRAINT FK_FB6B6B584584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEB40B389F1 FOREIGN KEY (parcelle_culture_id) REFERENCES parcelle_culture (id)');
        $this->addSql('ALTER TABLE parcelle_culture ADD CONSTRAINT FK_E0F33A324433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F347EFB FOREIGN KEY (produit_id) REFERENCES product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work_parcelle DROP FOREIGN KEY FK_10DBA6AABB3453DB');
        $this->addSql('ALTER TABLE work_parcelle DROP FOREIGN KEY FK_10DBA6AA4433ED66');
        $this->addSql('ALTER TABLE parcelle_culture DROP FOREIGN KEY FK_E0F33A324433ED66');
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEB40B389F1');
        $this->addSql('DROP TABLE work');
        $this->addSql('DROP TABLE work_parcelle');
        $this->addSql('DROP TABLE type_product');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE parcelle');
        $this->addSql('DROP TABLE parcelle_culture');
        $this->addSql('DROP TABLE stock');
    }
}
