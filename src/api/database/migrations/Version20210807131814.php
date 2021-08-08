<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210807131814 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE history_items (id INT AUTO_INCREMENT NOT NULL, info_id INT DEFAULT NULL, time DATETIME NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_B8A6E12A5D8BC1F8 (info_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infos (id INT AUTO_INCREMENT NOT NULL, solved TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history_items ADD CONSTRAINT FK_B8A6E12A5D8BC1F8 FOREIGN KEY (info_id) REFERENCES infos (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE history_items DROP FOREIGN KEY FK_B8A6E12A5D8BC1F8');
        $this->addSql('DROP TABLE history_items');
        $this->addSql('DROP TABLE infos');
    }
}
