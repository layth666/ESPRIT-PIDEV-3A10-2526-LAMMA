<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Compatible import phpMyAdmin `equipement.sql` (base gestion_equipement) :
 * - si `equipement` existe : InnoDB + colonnes LAMMA (caracteristiques, nombre_vues) + tables vues/attributs ;
 * - sinon : création complète.
 */
final class Version20260405120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'LAMMA boutique : schéma equipement (import XAMPP) + extensions';
    }

    public function up(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();
        if ($platform instanceof MySQLPlatform) {
            $this->upMysql();

            return;
        }
        if ($platform instanceof PostgreSQLPlatform) {
            $this->upPostgresFresh();

            return;
        }

        $this->abortIf(true, 'Utilisez MySQL/MariaDB (XAMPP) ou PostgreSQL.');
    }

    public function down(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();
        if ($platform instanceof MySQLPlatform) {
            $this->addSql('SET FOREIGN_KEY_CHECKS=0');
            $this->addSql('DROP TABLE IF EXISTS equipement_attributs');
            $this->addSql('DROP TABLE IF EXISTS equipement_vues');
            $this->addSql('DROP TABLE IF EXISTS equipement');
            $this->addSql('SET FOREIGN_KEY_CHECKS=1');

            return;
        }
        if ($platform instanceof PostgreSQLPlatform) {
            $this->downPostgres();
        }
    }

    private function upMysql(): void
    {
        $sm = $this->connection->createSchemaManager();
        $tables = $sm->listTableNames();

        if (!in_array('equipement', $tables, true)) {
            $this->addSql(<<<'SQL'
CREATE TABLE equipement (
    id BIGINT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    description LONGTEXT DEFAULT NULL,
    categorie VARCHAR(50) DEFAULT NULL,
    type VARCHAR(20) NOT NULL,
    prix NUMERIC(10, 2) NOT NULL,
    ville VARCHAR(100) DEFAULT NULL,
    statut VARCHAR(20) DEFAULT 'DISPONIBLE' NOT NULL,
    date_ajout DATETIME DEFAULT NULL,
    mail VARCHAR(150) DEFAULT NULL,
    caracteristiques LONGTEXT DEFAULT NULL,
    nombre_vues INT DEFAULT 0 NOT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
SQL);
        } else {
            $this->addSql('ALTER TABLE equipement ENGINE=InnoDB');

            $names = [];
            foreach ($sm->listTableColumns('equipement') as $col) {
                $names[] = strtolower($col->getName());
            }
            if (!in_array('caracteristiques', $names, true)) {
                $this->addSql('ALTER TABLE equipement ADD caracteristiques LONGTEXT DEFAULT NULL');
            }
            if (!in_array('nombre_vues', $names, true)) {
                $this->addSql('ALTER TABLE equipement ADD nombre_vues INT NOT NULL DEFAULT 0');
            }
        }

        $tablesAfter = $this->connection->createSchemaManager()->listTableNames();
        if (!in_array('equipement_vues', $tablesAfter, true)) {
            $this->addSql(<<<'SQL'
CREATE TABLE equipement_vues (
    id INT AUTO_INCREMENT NOT NULL,
    equipement_id BIGINT NOT NULL,
    user_id VARCHAR(255) NOT NULL,
    last_viewed DATETIME NOT NULL,
    UNIQUE INDEX uniq_equipement_user (equipement_id, user_id),
    INDEX IDX_EQ_VUE_EQ (equipement_id),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
SQL);
            $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_EQ_VUE_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        }

        $tablesAfter = $this->connection->createSchemaManager()->listTableNames();
        if (!in_array('equipement_attributs', $tablesAfter, true)) {
            $this->addSql(<<<'SQL'
CREATE TABLE equipement_attributs (
    id INT AUTO_INCREMENT NOT NULL,
    equipement_id BIGINT NOT NULL,
    nom_attribut VARCHAR(100) NOT NULL,
    valeur VARCHAR(255) DEFAULT NULL,
    description LONGTEXT DEFAULT NULL,
    INDEX IDX_EQ_ATTR_EQ (equipement_id),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
SQL);
            $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_EQ_ATTR_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        }
    }

    private function upPostgresFresh(): void
    {
        $this->addSql('CREATE TABLE equipement (id BIGSERIAL NOT NULL, nom VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, categorie VARCHAR(50) DEFAULT NULL, type VARCHAR(20) NOT NULL, prix NUMERIC(10, 2) NOT NULL, ville VARCHAR(100) DEFAULT NULL, statut VARCHAR(20) DEFAULT \'DISPONIBLE\' NOT NULL, date_ajout TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, mail VARCHAR(150) DEFAULT NULL, caracteristiques TEXT DEFAULT NULL, nombre_vues INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipement_vues (id SERIAL NOT NULL, equipement_id BIGINT NOT NULL, user_id VARCHAR(255) NOT NULL, last_viewed TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_equipement_user ON equipement_vues (equipement_id, user_id)');
        $this->addSql('CREATE INDEX IDX_EQ_VUE_EQ ON equipement_vues (equipement_id)');
        $this->addSql('CREATE TABLE equipement_attributs (id SERIAL NOT NULL, equipement_id BIGINT NOT NULL, nom_attribut VARCHAR(100) NOT NULL, valeur VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EQ_ATTR_EQ ON equipement_attributs (equipement_id)');
        $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_EQ_VUE_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_EQ_ATTR_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    private function downPostgres(): void
    {
        $this->addSql('ALTER TABLE equipement_attributs DROP CONSTRAINT FK_EQ_ATTR_EQ');
        $this->addSql('ALTER TABLE equipement_vues DROP CONSTRAINT FK_EQ_VUE_EQ');
        $this->addSql('DROP TABLE equipement_attributs');
        $this->addSql('DROP TABLE equipement_vues');
        $this->addSql('DROP TABLE equipement');
    }
}
