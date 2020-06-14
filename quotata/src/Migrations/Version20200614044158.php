<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614044158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE friend_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE friend_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE friends_group_members_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE kick_vote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE friend_alias_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE phrase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE friends_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE friend_list (id INT NOT NULL, owner_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEB224F87E3C61F9 ON friend_list (owner_id)');
        $this->addSql('CREATE TABLE quote (id INT NOT NULL, author_id INT DEFAULT NULL, friend_group_id INT DEFAULT NULL, created DATE NOT NULL, rating INT DEFAULT NULL, title VARCHAR(255) NOT NULL, image JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B71CBF4F675F31B ON quote (author_id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF469B2BF0D ON quote (friend_group_id)');
        $this->addSql('CREATE TABLE friend_request (id INT NOT NULL, accepting_user_id INT NOT NULL, friend_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_accepted BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F284D948111C1C6 ON friend_request (accepting_user_id)');
        $this->addSql('CREATE INDEX IDX_F284D946A5458E8 ON friend_request (friend_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, author_id INT DEFAULT NULL, quote_id INT DEFAULT NULL, text TEXT NOT NULL, rating INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526CDB805178 ON comment (quote_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(60) DEFAULT NULL, first_name VARCHAR(30) NOT NULL, second_name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE friends_group_members (id INT NOT NULL, group_user_id INT NOT NULL, friends_group_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12394AD1216E8799 ON friends_group_members (group_user_id)');
        $this->addSql('CREATE INDEX IDX_12394AD1136B3191 ON friends_group_members (friends_group_id)');
        $this->addSql('CREATE TABLE kick_vote (id INT NOT NULL, user_to_kick_id INT DEFAULT NULL, voter_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEE11BC4B96C0357 ON kick_vote (user_to_kick_id)');
        $this->addSql('CREATE INDEX IDX_EEE11BC4EBB4B8AD ON kick_vote (voter_id)');
        $this->addSql('CREATE TABLE friend_alias (id INT NOT NULL, owner_id INT DEFAULT NULL, friend_id INT DEFAULT NULL, label VARCHAR(40) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_41FCF3307E3C61F9 ON friend_alias (owner_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_41FCF3306A5458E8 ON friend_alias (friend_id)');
        $this->addSql('CREATE TABLE phrase (id INT NOT NULL, quote_id INT DEFAULT NULL, friend_alias_id INT DEFAULT NULL, text TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A24BE60CDB805178 ON phrase (quote_id)');
        $this->addSql('CREATE INDEX IDX_A24BE60CC9B02CA8 ON phrase (friend_alias_id)');
        $this->addSql('CREATE TABLE friends_group (id INT NOT NULL, name VARCHAR(255) NOT NULL, created DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE friend_list ADD CONSTRAINT FK_DEB224F87E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF469B2BF0D FOREIGN KEY (friend_group_id) REFERENCES friends_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D948111C1C6 FOREIGN KEY (accepting_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D946A5458E8 FOREIGN KEY (friend_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friends_group_members ADD CONSTRAINT FK_12394AD1216E8799 FOREIGN KEY (group_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friends_group_members ADD CONSTRAINT FK_12394AD1136B3191 FOREIGN KEY (friends_group_id) REFERENCES friends_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kick_vote ADD CONSTRAINT FK_EEE11BC4B96C0357 FOREIGN KEY (user_to_kick_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kick_vote ADD CONSTRAINT FK_EEE11BC4EBB4B8AD FOREIGN KEY (voter_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_alias ADD CONSTRAINT FK_41FCF3307E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend_alias ADD CONSTRAINT FK_41FCF3306A5458E8 FOREIGN KEY (friend_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE phrase ADD CONSTRAINT FK_A24BE60CDB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE phrase ADD CONSTRAINT FK_A24BE60CC9B02CA8 FOREIGN KEY (friend_alias_id) REFERENCES friend_alias (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CDB805178');
        $this->addSql('ALTER TABLE phrase DROP CONSTRAINT FK_A24BE60CDB805178');
        $this->addSql('ALTER TABLE friend_list DROP CONSTRAINT FK_DEB224F87E3C61F9');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF4F675F31B');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D948111C1C6');
        $this->addSql('ALTER TABLE friend_request DROP CONSTRAINT FK_F284D946A5458E8');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE friends_group_members DROP CONSTRAINT FK_12394AD1216E8799');
        $this->addSql('ALTER TABLE kick_vote DROP CONSTRAINT FK_EEE11BC4B96C0357');
        $this->addSql('ALTER TABLE kick_vote DROP CONSTRAINT FK_EEE11BC4EBB4B8AD');
        $this->addSql('ALTER TABLE friend_alias DROP CONSTRAINT FK_41FCF3307E3C61F9');
        $this->addSql('ALTER TABLE friend_alias DROP CONSTRAINT FK_41FCF3306A5458E8');
        $this->addSql('ALTER TABLE phrase DROP CONSTRAINT FK_A24BE60CC9B02CA8');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF469B2BF0D');
        $this->addSql('ALTER TABLE friends_group_members DROP CONSTRAINT FK_12394AD1136B3191');
        $this->addSql('DROP SEQUENCE friend_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quote_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE friend_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE friends_group_members_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE kick_vote_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE friend_alias_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE phrase_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE friends_group_id_seq CASCADE');
        $this->addSql('DROP TABLE friend_list');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE friend_request');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE friends_group_members');
        $this->addSql('DROP TABLE kick_vote');
        $this->addSql('DROP TABLE friend_alias');
        $this->addSql('DROP TABLE phrase');
        $this->addSql('DROP TABLE friends_group');
    }
}
