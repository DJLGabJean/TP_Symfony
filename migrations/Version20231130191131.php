<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130191131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothing (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_139C38B144F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothing_category (clothing_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_8C91ACCA4CFB3290 (clothing_id), INDEX IDX_8C91ACCA12469DE2 (category_id), PRIMARY KEY(clothing_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothing_size (clothing_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_273BA59D4CFB3290 (clothing_id), INDEX IDX_273BA59D498DA827 (size_id), PRIMARY KEY(clothing_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clothing ADD CONSTRAINT FK_139C38B144F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE clothing_category ADD CONSTRAINT FK_8C91ACCA4CFB3290 FOREIGN KEY (clothing_id) REFERENCES clothing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clothing_category ADD CONSTRAINT FK_8C91ACCA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clothing_size ADD CONSTRAINT FK_273BA59D4CFB3290 FOREIGN KEY (clothing_id) REFERENCES clothing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clothing_size ADD CONSTRAINT FK_273BA59D498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothing DROP FOREIGN KEY FK_139C38B144F5D008');
        $this->addSql('ALTER TABLE clothing_category DROP FOREIGN KEY FK_8C91ACCA4CFB3290');
        $this->addSql('ALTER TABLE clothing_category DROP FOREIGN KEY FK_8C91ACCA12469DE2');
        $this->addSql('ALTER TABLE clothing_size DROP FOREIGN KEY FK_273BA59D4CFB3290');
        $this->addSql('ALTER TABLE clothing_size DROP FOREIGN KEY FK_273BA59D498DA827');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE clothing');
        $this->addSql('DROP TABLE clothing_category');
        $this->addSql('DROP TABLE clothing_size');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
