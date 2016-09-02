<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160901221519 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("
            INSERT INTO tickets (fk_customer, fk_order, title, observation, created_at) VALUES 
            (1, 1, 'titulo teste', 'obsersacao teste', NOW()),
            (1, 6, 'titulo teste', 'obsersacao teste', NOW()),
            (3, 4, 'titulo teste', 'obsersacao teste', NOW()),
            (6, 10, 'titulo teste', 'obsersacao teste', NOW()),
            (7, 3, 'titulo teste', 'obsersacao teste', NOW()),
            (4, 9, 'titulo teste', 'obsersacao teste', NOW()),
            (9, 7, 'titulo teste', 'obsersacao teste', NOW()),
            (10, 2, 'titulo teste', 'obsersacao teste', NOW()),
            (2, 8, 'titulo teste', 'obsersacao teste', NOW()),
            (7, 5, 'titulo teste', 'obsersacao teste', NOW());
        ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DELETE FROM customers');
    }
}
