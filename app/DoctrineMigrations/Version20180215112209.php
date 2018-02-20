<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215112209 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, id_team1 INT DEFAULT NULL, id_team2 INT DEFAULT NULL, levels VARCHAR(255) NOT NULL, dates VARCHAR(255) NOT NULL, times VARCHAR(255) NOT NULL, stadiums VARCHAR(255) NOT NULL, INDEX IDX_6B1E6041E09543D4 (id_team1), INDEX IDX_6B1E6041799C126E (id_team2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041E09543D4 FOREIGN KEY (id_team1) REFERENCES team_test (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041799C126E FOREIGN KEY (id_team2) REFERENCES team_test (id)');
        $this->addSql('DROP TABLE `match`');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, id_team1 INT DEFAULT NULL, id_team2 INT DEFAULT NULL, levels VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dates VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, times VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, stadiums VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_7A5BC505E09543D4 (id_team1), INDEX IDX_7A5BC505799C126E (id_team2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505799C126E FOREIGN KEY (id_team2) REFERENCES team_test (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505E09543D4 FOREIGN KEY (id_team1) REFERENCES team_test (id)');
        $this->addSql('DROP TABLE matchs');
    }
}
