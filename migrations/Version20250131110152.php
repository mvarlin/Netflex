<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Création de la base de données
 */
final class Version20250131110152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, duration TIME NOT NULL, release_date DATETIME NOT NULL, INDEX IDX_DDAA1CDA4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, code VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, playlist_media_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, short_description LONGTEXT NOT NULL, long_description LONGTEXT NOT NULL, release_date DATETIME NOT NULL, cover_image VARCHAR(255) NOT NULL, staff JSON NOT NULL, casting JSON NOT NULL, media_type VARCHAR(255) NOT NULL, mediaType VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10C17421B18 (playlist_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_language (media_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_DBBA5F07EA9FDD75 (media_id), INDEX IDX_DBBA5F0782F1BAF4 (language_id), PRIMARY KEY(media_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_categorie (media_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_6C1D65BAEA9FDD75 (media_id), INDEX IDX_6C1D65BABCF5E72D (categorie_id), PRIMARY KEY(media_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, playlist_media_id INT DEFAULT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D782112D17421B18 (playlist_media_id), INDEX IDX_D782112DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media (id INT AUTO_INCREMENT NOT NULL, added_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscription (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, playlist_id INT DEFAULT NULL, suscribed_at DATETIME NOT NULL, INDEX IDX_832940CF675F31B (author_id), INDEX IDX_832940C6BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, season_number INT NOT NULL, INDEX IDX_F0E45BA9D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, duration_in_months INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_history (id INT AUTO_INCREMENT NOT NULL, subscriber_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_54AF90D07808B1AD (subscriber_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, current_subscription_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, account_status VARCHAR(255) NOT NULL, INDEX IDX_8D93D649DDE45DDE (current_subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch_history (id INT AUTO_INCREMENT NOT NULL, viewer_id INT DEFAULT NULL, last_watched DATETIME NOT NULL, number_of_views INT NOT NULL, INDEX IDX_DE44EFD86C59C752 (viewer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C17421B18 FOREIGN KEY (playlist_media_id) REFERENCES playlist_media (id)');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_DBBA5F07EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_DBBA5F0782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_categorie ADD CONSTRAINT FK_6C1D65BAEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_categorie ADD CONSTRAINT FK_6C1D65BABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D17421B18 FOREIGN KEY (playlist_media_id) REFERENCES playlist_media (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D07808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649DDE45DDE FOREIGN KEY (current_subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD86C59C752 FOREIGN KEY (viewer_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C17421B18');
        $this->addSql('ALTER TABLE media_language DROP FOREIGN KEY FK_DBBA5F07EA9FDD75');
        $this->addSql('ALTER TABLE media_language DROP FOREIGN KEY FK_DBBA5F0782F1BAF4');
        $this->addSql('ALTER TABLE media_categorie DROP FOREIGN KEY FK_6C1D65BAEA9FDD75');
        $this->addSql('ALTER TABLE media_categorie DROP FOREIGN KEY FK_6C1D65BABCF5E72D');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D17421B18');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DF675F31B');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CF675F31B');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D07808B1AD');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649DDE45DDE');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD86C59C752');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_language');
        $this->addSql('DROP TABLE media_categorie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_media');
        $this->addSql('DROP TABLE playlist_subscription');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE subscription_history');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE watch_history');
    }
}
