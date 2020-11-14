<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114112122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE channel (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, public_id VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, rights VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_A2F98E47B5B48B91 (public_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_rates (id INT AUTO_INCREMENT NOT NULL, listing_id INT NOT NULL, rate SMALLINT NOT NULL, user_ip VARCHAR(30) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B23A73B0D4619D1A (listing_id), INDEX IDX_B23A73B0BDB407E8D4619D1A (user_ip, listing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listings (id INT AUTO_INCREMENT NOT NULL, channel_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, public_id VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, summary LONGTEXT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_9A7BD98EB5B48B91 (public_id), INDEX IDX_9A7BD98E72F5A1AA (channel_id), INDEX IDX_9A7BD98EB5B48B9172F5A1AA (public_id, channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_rates ADD CONSTRAINT FK_B23A73B0D4619D1A FOREIGN KEY (listing_id) REFERENCES listings (id)');
        $this->addSql('ALTER TABLE listings ADD CONSTRAINT FK_9A7BD98E72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE listings DROP FOREIGN KEY FK_9A7BD98E72F5A1AA');
        $this->addSql('ALTER TABLE listing_rates DROP FOREIGN KEY FK_B23A73B0D4619D1A');
        $this->addSql('DROP TABLE channel');
        $this->addSql('DROP TABLE listing_rates');
        $this->addSql('DROP TABLE listings');
    }
}
