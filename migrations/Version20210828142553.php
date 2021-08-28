<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828142553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP is_cover');
        $this->addSql('ALTER TABLE plant ADD cover_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72922726E9 FOREIGN KEY (cover_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_AB030D72922726E9 ON plant (cover_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD is_cover TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72922726E9');
        $this->addSql('DROP INDEX IDX_AB030D72922726E9 ON plant');
        $this->addSql('ALTER TABLE plant DROP cover_id');
    }
}
