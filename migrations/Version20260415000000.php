<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260415000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add sentiment analysis fields to sponsor_feedback table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsor_feedback ADD sentiment_score DOUBLE PRECISION DEFAULT NULL, ADD sentiment_label VARCHAR(20) DEFAULT NULL, ADD sentiment_confidence DOUBLE PRECISION DEFAULT NULL, ADD analyzed_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsor_feedback DROP sentiment_score, DROP sentiment_label, DROP sentiment_confidence, DROP analyzed_at');
    }
}