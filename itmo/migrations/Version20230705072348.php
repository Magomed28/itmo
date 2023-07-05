<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705072348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author CHANGE fio fio VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE author_book ADD PRIMARY KEY (author_id, book_id)');
        $this->addSql('CREATE UNIQUE INDEX author_UN ON author (fio)');
        $this->addSql('CREATE UNIQUE INDEX book_UN ON book (isbn, name)');
        $this->addSql('ALTER TABLE book CHANGE name name VARCHAR(255) NOT NULL, CHANGE isbn isbn VARCHAR(255) NOT NULL, CHANGE number_pages number_pages INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE author CHANGE fio fio VARCHAR(300) NOT NULL');
        $this->addSql('ALTER TABLE book CHANGE name name VARCHAR(500) NOT NULL, CHANGE isbn isbn VARCHAR(32) NOT NULL, CHANGE number_pages number_pages SMALLINT UNSIGNED NOT NULL');
        $this->addSql('DROP INDEX book_UN ON book');
        $this->addSql('DROP INDEX author_UN ON author');
    }
}
