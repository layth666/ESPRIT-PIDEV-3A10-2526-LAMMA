<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260419173914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10806F0F5C');
        $this->addSql('ALTER TABLE equipement_attributs DROP FOREIGN KEY FK_EQ_ATTR_EQ');
        $this->addSql('ALTER TABLE equipement_vues DROP FOREIGN KEY FK_EQ_VUE_EQ');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1806F0F5C');
        $this->addSql('RENAME TABLE equipement TO equipements');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10806F0F5C');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipements (id)');
        $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_32B26F75806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_370ACB3806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1806F0F5C');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10806F0F5C');
        $this->addSql('ALTER TABLE equipement_attributs DROP FOREIGN KEY FK_32B26F75806F0F5C');
        $this->addSql('ALTER TABLE equipement_vues DROP FOREIGN KEY FK_370ACB3806F0F5C');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1806F0F5C');
        $this->addSql('RENAME TABLE equipements TO equipement');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10806F0F5C');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE equipement_attributs ADD CONSTRAINT FK_EQ_ATTR_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vues ADD CONSTRAINT FK_EQ_VUE_EQ FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1806F0F5C');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
    }
}
