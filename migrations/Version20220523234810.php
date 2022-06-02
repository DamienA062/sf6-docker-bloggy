<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523234810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create post, user and messenger_messages tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `posts` (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_885DBAFA989D9B62 (slug), INDEX IDX_885DBAFAF675F31B (author_id), UNIQUE INDEX unique_slug_for_published_date (slug, published_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `posts` ADD CONSTRAINT FK_885DBAFAF675F31B FOREIGN KEY (author_id) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `posts` DROP FOREIGN KEY FK_885DBAFAF675F31B');
        $this->addSql('DROP TABLE `posts`');
        $this->addSql('DROP TABLE `users`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
