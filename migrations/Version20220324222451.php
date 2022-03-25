<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324222451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_5ACE3AF04B89032C');
        $this->addSql('DROP INDEX IDX_5ACE3AF0BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post_tag AS SELECT post_id, tag_id FROM post_tag');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('CREATE TABLE post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id), CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__post_tag');
        $this->addSql('DROP TABLE __temp__post_tag');
        $this->addSql('CREATE INDEX IDX_5ACE3AF04B89032C ON post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_5ACE3AF0BAD26311 ON post_tag (tag_id)');
        $this->addSql('ALTER TABLE tag ADD COLUMN categ VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_5ACE3AF04B89032C');
        $this->addSql('DROP INDEX IDX_5ACE3AF0BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post_tag AS SELECT post_id, tag_id FROM post_tag');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('CREATE TABLE post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('INSERT INTO post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__post_tag');
        $this->addSql('DROP TABLE __temp__post_tag');
        $this->addSql('CREATE INDEX IDX_5ACE3AF04B89032C ON post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_5ACE3AF0BAD26311 ON post_tag (tag_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag AS SELECT id, name FROM tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO tag (id, name) SELECT id, name FROM __temp__tag');
        $this->addSql('DROP TABLE __temp__tag');
    }
}
