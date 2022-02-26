<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225180109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD COLUMN description CLOB DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D96CF1FFA76ED395');
        $this->addSql('DROP INDEX IDX_D96CF1FF71F7E88B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_event AS SELECT user_id, event_id FROM user_event');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('CREATE TABLE user_event (user_id INTEGER NOT NULL, event_id INTEGER NOT NULL, PRIMARY KEY(user_id, event_id), CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_event (user_id, event_id) SELECT user_id, event_id FROM __temp__user_event');
        $this->addSql('DROP TABLE __temp__user_event');
        $this->addSql('CREATE INDEX IDX_D96CF1FFA76ED395 ON user_event (user_id)');
        $this->addSql('CREATE INDEX IDX_D96CF1FF71F7E88B ON user_event (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, name, start_date, end_date, location, city, postal_code, price, number_places, active FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, location VARCHAR(255) DEFAULT NULL, city VARCHAR(100) NOT NULL, postal_code VARCHAR(5) NOT NULL, price NUMERIC(5, 2) NOT NULL, number_places INTEGER NOT NULL, active BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO event (id, name, start_date, end_date, location, city, postal_code, price, number_places, active) SELECT id, name, start_date, end_date, location, city, postal_code, price, number_places, active FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
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
