<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160901221517 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("
            INSERT INTO customers (name, email, created_at) VALUES 
            ('Luis Barbosa Cavalcanti', 'LuisBarbosaCavalcanti@armyspy.com', NOW()),
            ('Larissa Oliveira Cavalcanti', 'LarissaOliveiraCavalcanti@armyspy.com', NOW()),
            ('Vitória Rocha Azevedo', 'VitoriaRochaAzevedo@teleworm.us', NOW()),
            ('Arthur Azevedo Cavalcanti', 'ArthurAzevedoCavalcanti@jourrapide.com', NOW()),
            ('Maria Azevedo Ribeiro', 'LuisBarbosaCavalcanti@armyspy.com', NOW()),
            ('Renan Oliveira Carvalho', 'RenanOliveiraCarvalho@teleworm.us', NOW()),
            ('Rebeca Alves Fernandes', 'RebecaAlvesFernandes@armyspy.com', NOW()),
            ('Evelyn Lima Barbosa', 'EvelynLimaBarbosa@dayrep.com', NOW()),
            ('Arthur Lima Rocha', 'ArthurLimaRocha@teleworm.us', NOW()),
            ('Camila Alves Barros', 'CamilaAlvesBarros@rhyta.com', NOW());
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
