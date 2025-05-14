<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513102345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__passenger AS SELECT id, first_name, last_name, passport FROM passenger
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE passenger
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE passenger (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, passport VARCHAR(255) NOT NULL, CONSTRAINT FK_3BEFE8DD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO passenger (id, first_name, last_name, passport) SELECT id, first_name, last_name, passport FROM __temp__passenger
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__passenger
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3BEFE8DD19EB6921 ON passenger (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, ticket_number, fare FROM ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ticket
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, passenger_id INTEGER NOT NULL, ticket_number VARCHAR(255) NOT NULL, fare INTEGER NOT NULL, CONSTRAINT FK_97A0ADA34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO ticket (id, ticket_number, fare) SELECT id, ticket_number, fare FROM __temp__ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__ticket
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_97A0ADA34502E565 ON ticket (passenger_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__passenger AS SELECT id, first_name, last_name, passport FROM passenger
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE passenger
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE passenger (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, passport VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO passenger (id, first_name, last_name, passport) SELECT id, first_name, last_name, passport FROM __temp__passenger
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__passenger
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, ticket_number, fare FROM ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ticket
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticket_number VARCHAR(255) NOT NULL, fare INTEGER NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO ticket (id, ticket_number, fare) SELECT id, ticket_number, fare FROM __temp__ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__ticket
        SQL);
    }
}
