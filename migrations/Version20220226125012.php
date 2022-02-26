<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220226125012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('DROP INDEX IDX_D96CF1FF71F7E88B');
        $this->addSql('DROP INDEX IDX_D96CF1FFA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_event AS SELECT user_id, event_id FROM user_event');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('CREATE TABLE user_event (user_id INTEGER NOT NULL, event_id INTEGER NOT NULL, PRIMARY KEY(user_id, event_id), CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_event (user_id, event_id) SELECT user_id, event_id FROM __temp__user_event');
        $this->addSql('DROP TABLE __temp__user_event');
        $this->addSql('CREATE INDEX IDX_D96CF1FF71F7E88B ON user_event (event_id)');
        $this->addSql('CREATE INDEX IDX_D96CF1FFA76ED395 ON user_event (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP INDEX IDX_D96CF1FFA76ED395');
        $this->addSql('DROP INDEX IDX_D96CF1FF71F7E88B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_event AS SELECT user_id, event_id FROM user_event');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('CREATE TABLE user_event (user_id INTEGER NOT NULL, event_id INTEGER NOT NULL, PRIMARY KEY(user_id, event_id))');
        $this->addSql('INSERT INTO user_event (user_id, event_id) SELECT user_id, event_id FROM __temp__user_event');
        $this->addSql('DROP TABLE __temp__user_event');
        $this->addSql('CREATE INDEX IDX_D96CF1FFA76ED395 ON user_event (user_id)');
        $this->addSql('CREATE INDEX IDX_D96CF1FF71F7E88B ON user_event (event_id)');
    }
}
