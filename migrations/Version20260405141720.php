<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260405141720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, equipement_id BIGINT NOT NULL, estimation DATETIME DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(20) DEFAULT NULL, pays VARCHAR(100) DEFAULT NULL, statut VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_3781EC10806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('DROP TABLE groupe_chat');
        $this->addSql('DROP TABLE message_chat');
        $this->addSql('DROP TABLE message_reactions');
        $this->addSql('DROP TABLE sondage_options');
        $this->addSql('DROP TABLE sondage_votes');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE equipement CHANGE description description LONGTEXT DEFAULT NULL, CHANGE statut statut VARCHAR(20) DEFAULT \'DISPONIBLE\' NOT NULL, CHANGE date_ajout date_ajout DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE equipement_attributs DROP FOREIGN KEY FK_EQ_ATTR_EQ');
        $this->addSql('DROP INDEX idx_eq_attr_eq ON equipement_attributs');
        $this->addSql('CREATE INDEX IDX_32B26F75806F0F5C ON equipement_attributs (equipement_id)');
        $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_EQ_ATTR_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vues DROP FOREIGN KEY FK_EQ_VUE_EQ');
        $this->addSql('DROP INDEX idx_eq_vue_eq ON equipement_vues');
        $this->addSql('CREATE INDEX IDX_370ACB3806F0F5C ON equipement_vues (equipement_id)');
        $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_EQ_VUE_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_chat (id BIGINT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'PUBLIC\' NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP, id_createur INT DEFAULT 1, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message_chat (id INT AUTO_INCREMENT NOT NULL, contenu TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP, id_groupe INT NOT NULL, id_user INT DEFAULT 1, type_message VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'TEXT\' COLLATE `utf8mb4_unicode_ci`, fichier_path TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX fk_groupe (id_groupe), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message_reactions (id INT AUTO_INCREMENT NOT NULL, id_message INT NOT NULL, id_user INT NOT NULL, emoji VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP, UNIQUE INDEX unique_reaction (id_message, id_user, emoji), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sondage_options (id INT AUTO_INCREMENT NOT NULL, message_id INT NOT NULL, option_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, votes INT DEFAULT 0, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sondage_votes (id INT AUTO_INCREMENT NOT NULL, option_id INT NOT NULL, user_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'USER\' NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10806F0F5C');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE equipement CHANGE description description TEXT DEFAULT NULL, CHANGE statut statut VARCHAR(20) DEFAULT \'DISPONIBLE\', CHANGE date_ajout date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE equipement_attributs DROP FOREIGN KEY FK_32B26F75806F0F5C');
        $this->addSql('DROP INDEX idx_32b26f75806f0f5c ON equipement_attributs');
        $this->addSql('CREATE INDEX IDX_EQ_ATTR_EQ ON equipement_attributs (equipement_id)');
        $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_32B26F75806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vues DROP FOREIGN KEY FK_370ACB3806F0F5C');
        $this->addSql('DROP INDEX idx_370acb3806f0f5c ON equipement_vues');
        $this->addSql('CREATE INDEX IDX_EQ_VUE_EQ ON equipement_vues (equipement_id)');
        $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_370ACB3806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }
}
