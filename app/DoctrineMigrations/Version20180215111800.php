<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215111800 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` ADD levels VARCHAR(255) NOT NULL, ADD dates VARCHAR(255) NOT NULL, ADD times VARCHAR(255) NOT NULL, ADD stadiums VARCHAR(255) NOT NULL, DROP date, DROP stadium, DROP level, DROP time');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` ADD date VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD stadium VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD level VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD time VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP levels, DROP dates, DROP times, DROP stadiums');
    }
}
