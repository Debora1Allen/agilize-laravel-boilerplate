<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221017204327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prova DROP CONSTRAINT fk_fe9d7c66b2ddf7f4');
        $this->addSql('ALTER TABLE resposta_prova DROP CONSTRAINT fk_4dee2f1ade32aaeb');
        $this->addSql('ALTER TABLE questao_prova DROP CONSTRAINT fk_e1952e2f272fab5f');
        $this->addSql('ALTER TABLE questao_prova DROP CONSTRAINT fk_e1952e2fa64a8a17');
        $this->addSql('ALTER TABLE prova DROP CONSTRAINT fk_fe9d7c66a64a8a17');
        $this->addSql('ALTER TABLE questoes DROP CONSTRAINT fk_2b93b1afa64a8a17');
        $this->addSql('CREATE TABLE alunos (id UUID NOT NULL, nome VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resposta-prova (id UUID NOT NULL, questao_id UUID DEFAULT NULL, resposta VARCHAR(255) NOT NULL, is_correta BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B0483D0CB1A8E7E ON resposta-prova (questao_id)');
        $this->addSql('ALTER TABLE resposta-prova ADD CONSTRAINT FK_B0483D0CB1A8E7E FOREIGN KEY (questao_id) REFERENCES questoes_prova (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE questao_prova');
        $this->addSql('DROP TABLE resposta_prova');
        $this->addSql('DROP TABLE prova');
        $this->addSql('DROP TABLE tema');
        $this->addSql('ALTER TABLE provas ADD CONSTRAINT FK_BF21961AB2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES alunos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE provas ADD CONSTRAINT FK_BF21961AA64A8A17 FOREIGN KEY (tema_id) REFERENCES temas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questoes DROP CONSTRAINT FK_2B93B1AFA64A8A17');
        $this->addSql('ALTER TABLE questoes ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE questoes ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE questoes RENAME COLUMN texto TO pergunta');
        $this->addSql('ALTER TABLE questoes ADD CONSTRAINT FK_2B93B1AFA64A8A17 FOREIGN KEY (tema_id) REFERENCES temas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questoes_prova ADD CONSTRAINT FK_2AA5F52E272FAB5F FOREIGN KEY (prova_id) REFERENCES provas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE repostas ADD CONSTRAINT FK_DD017205CB1A8E7E FOREIGN KEY (questao_id) REFERENCES questoes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE provas DROP CONSTRAINT FK_BF21961AB2DDF7F4');
        $this->addSql('CREATE TABLE aluno (id UUID NOT NULL, nome VARCHAR(255) NOT NULL, telefone INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE questao_prova (id UUID NOT NULL, prova_id UUID DEFAULT NULL, tema_id UUID DEFAULT NULL, texto VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_e1952e2fa64a8a17 ON questao_prova (tema_id)');
        $this->addSql('CREATE INDEX idx_e1952e2f272fab5f ON questao_prova (prova_id)');
        $this->addSql('CREATE TABLE resposta_prova (id UUID NOT NULL, questao_prova_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4dee2f1ade32aaeb ON resposta_prova (questao_prova_id)');
        $this->addSql('CREATE TABLE prova (id UUID NOT NULL, aluno_id UUID DEFAULT NULL, tema_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_fe9d7c66b2ddf7f4 ON prova (aluno_id)');
        $this->addSql('CREATE INDEX idx_fe9d7c66a64a8a17 ON prova (tema_id)');
        $this->addSql('CREATE TABLE tema (id UUID NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE questao_prova ADD CONSTRAINT fk_e1952e2f272fab5f FOREIGN KEY (prova_id) REFERENCES prova (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questao_prova ADD CONSTRAINT fk_e1952e2fa64a8a17 FOREIGN KEY (tema_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta_prova ADD CONSTRAINT fk_4dee2f1ade32aaeb FOREIGN KEY (questao_prova_id) REFERENCES questao_prova (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prova ADD CONSTRAINT fk_fe9d7c66b2ddf7f4 FOREIGN KEY (aluno_id) REFERENCES aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prova ADD CONSTRAINT fk_fe9d7c66a64a8a17 FOREIGN KEY (tema_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE alunos');
        $this->addSql('DROP TABLE resposta-prova');
        $this->addSql('ALTER TABLE provas DROP CONSTRAINT FK_BF21961AA64A8A17');
        $this->addSql('ALTER TABLE repostas DROP CONSTRAINT FK_DD017205CB1A8E7E');
        $this->addSql('ALTER TABLE questoes_prova DROP CONSTRAINT FK_2AA5F52E272FAB5F');
        $this->addSql('ALTER TABLE questoes DROP CONSTRAINT fk_2b93b1afa64a8a17');
        $this->addSql('ALTER TABLE questoes DROP created_at');
        $this->addSql('ALTER TABLE questoes DROP updated_at');
        $this->addSql('ALTER TABLE questoes RENAME COLUMN pergunta TO texto');
        $this->addSql('ALTER TABLE questoes ADD CONSTRAINT fk_2b93b1afa64a8a17 FOREIGN KEY (tema_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
