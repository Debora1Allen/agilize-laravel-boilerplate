<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006172613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questao_prova (id UUID NOT NULL, prova_id UUID DEFAULT NULL, tema_id UUID DEFAULT NULL, texto VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1952E2F272FAB5F ON questao_prova (prova_id)');
        $this->addSql('CREATE INDEX IDX_E1952E2FA64A8A17 ON questao_prova (tema_id)');
        $this->addSql('CREATE TABLE resposta_prova (id UUID NOT NULL, questao_prova_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4DEE2F1ADE32AAEB ON resposta_prova (questao_prova_id)');
        $this->addSql('ALTER TABLE questao_prova ADD CONSTRAINT FK_E1952E2F272FAB5F FOREIGN KEY (prova_id) REFERENCES prova (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questao_prova ADD CONSTRAINT FK_E1952E2FA64A8A17 FOREIGN KEY (tema_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta_prova ADD CONSTRAINT FK_4DEE2F1ADE32AAEB FOREIGN KEY (questao_prova_id) REFERENCES questao_prova (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resposta_prova DROP CONSTRAINT FK_4DEE2F1ADE32AAEB');
        $this->addSql('DROP TABLE questao_prova');
        $this->addSql('DROP TABLE resposta_prova');
    }
}
