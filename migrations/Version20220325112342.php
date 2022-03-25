<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325112342 extends AbstractMigration
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
        $this->addSql('DROP INDEX IDX_E2DF2515582E9C0');
        $this->addSql('DROP INDEX IDX_E2DF2514B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post_bloc AS SELECT post_id, bloc_id FROM post_bloc');
        $this->addSql('DROP TABLE post_bloc');
        $this->addSql('CREATE TABLE post_bloc (post_id INTEGER NOT NULL, bloc_id INTEGER NOT NULL, PRIMARY KEY(post_id, bloc_id), CONSTRAINT FK_E2DF2514B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E2DF2515582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post_bloc (post_id, bloc_id) SELECT post_id, bloc_id FROM __temp__post_bloc');
        $this->addSql('DROP TABLE __temp__post_bloc');
        $this->addSql('CREATE INDEX IDX_E2DF2515582E9C0 ON post_bloc (bloc_id)');
        $this->addSql('CREATE INDEX IDX_E2DF2514B89032C ON post_bloc (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_E2DF2514B89032C');
        $this->addSql('DROP INDEX IDX_E2DF2515582E9C0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post_bloc AS SELECT post_id, bloc_id FROM post_bloc');
        $this->addSql('DROP TABLE post_bloc');
        $this->addSql('CREATE TABLE post_bloc (post_id INTEGER NOT NULL, bloc_id INTEGER NOT NULL, PRIMARY KEY(post_id, bloc_id))');
        $this->addSql('INSERT INTO post_bloc (post_id, bloc_id) SELECT post_id, bloc_id FROM __temp__post_bloc');
        $this->addSql('DROP TABLE __temp__post_bloc');
        $this->addSql('CREATE INDEX IDX_E2DF2514B89032C ON post_bloc (post_id)');
        $this->addSql('CREATE INDEX IDX_E2DF2515582E9C0 ON post_bloc (bloc_id)');
        $this->addSql('DROP INDEX IDX_5ACE3AF04B89032C');
        $this->addSql('DROP INDEX IDX_5ACE3AF0BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post_tag AS SELECT post_id, tag_id FROM post_tag');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('CREATE TABLE post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('INSERT INTO post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__post_tag');
        $this->addSql('DROP TABLE __temp__post_tag');
        $this->addSql('CREATE INDEX IDX_5ACE3AF04B89032C ON post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_5ACE3AF0BAD26311 ON post_tag (tag_id)');
    }
}
