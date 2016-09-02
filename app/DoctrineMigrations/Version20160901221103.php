<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160901221103 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE customers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tickets_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customers (id INT DEFAULT nextval(\'customers_id_seq\'::regclass) NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE orders (id INT DEFAULT nextval(\'orders_id_seq\'::regclass) NOT NULL, fk_customer INT DEFAULT nextval(\'customers_id_seq\'::regclass), created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEB311CDD7 ON orders (fk_customer)');
        $this->addSql('CREATE TABLE tickets (id INT DEFAULT nextval(\'tickets_id_seq\'::regclass) NOT NULL, fk_customer INT DEFAULT nextval(\'customers_id_seq\'::regclass), fk_order INT DEFAULT nextval(\'orders_id_seq\'::regclass), title VARCHAR(200) NOT NULL, observation TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54469DF4B311CDD7 ON tickets (fk_customer)');
        $this->addSql('CREATE INDEX IDX_54469DF434C4B0ED ON tickets (fk_order)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB311CDD7 FOREIGN KEY (fk_customer) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4B311CDD7 FOREIGN KEY (fk_customer) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF434C4B0ED FOREIGN KEY (fk_order) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEB311CDD7');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT FK_54469DF4B311CDD7');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT FK_54469DF434C4B0ED');
        $this->addSql('DROP SEQUENCE customers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tickets_id_seq CASCADE');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE tickets');
    }
}
