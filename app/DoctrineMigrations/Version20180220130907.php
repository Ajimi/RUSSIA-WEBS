<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220130907 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, birthday DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, teamName VARCHAR(255) DEFAULT NULL, teamLogo VARCHAR(255) DEFAULT NULL, teamShortcut VARCHAR(255) DEFAULT NULL, matchWon INT DEFAULT NULL, matchLoss INT DEFAULT NULL, goalScored INT DEFAULT NULL, goalIn INT DEFAULT NULL, matchDraw INT DEFAULT NULL, participation INT DEFAULT NULL, winner INT DEFAULT NULL, second INT DEFAULT NULL, third INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, region_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, availableRooms INT NOT NULL, rate INT NOT NULL, stars INT NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_3535ED9989D9B62 (slug), UNIQUE INDEX UNIQ_3535ED964D218E (location_id), INDEX IDX_3535ED998260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, size NUMERIC(10, 0) NOT NULL, bedNumber INT NOT NULL, price NUMERIC(10, 2) NOT NULL, availability TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_729F519B3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matche (id INT AUTO_INCREMENT NOT NULL, team1 VARCHAR(255) NOT NULL, team2 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, match_id INT DEFAULT NULL, quantity INT DEFAULT NULL, price NUMERIC(4, 2) NOT NULL, UNIQUE INDEX UNIQ_97A0ADA32ABEACD6 (match_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, id_team1 INT DEFAULT NULL, id_team2 INT DEFAULT NULL, id_team3 INT DEFAULT NULL, id_team4 INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4B98C21E09543D4 (id_team1), UNIQUE INDEX UNIQ_4B98C21799C126E (id_team2), UNIQUE INDEX UNIQ_4B98C21E9B22F8 (id_team3), UNIQUE INDEX UNIQ_4B98C2190FFB75B (id_team4), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, id_team1 INT DEFAULT NULL, id_team2 INT DEFAULT NULL, levels VARCHAR(255) NOT NULL, dates VARCHAR(255) NOT NULL, times VARCHAR(255) NOT NULL, stadiums VARCHAR(255) NOT NULL, played TINYINT(1) NOT NULL, INDEX IDX_7A5BC505E09543D4 (id_team1), INDEX IDX_7A5BC505799C126E (id_team2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, id_team INT DEFAULT NULL, id_match INT DEFAULT NULL, shots INT NOT NULL, corner_kicks INT NOT NULL, saves INT NOT NULL, yellow_cards INT NOT NULL, red_cards INT NOT NULL, INDEX IDX_E2D38B224FC0BA1D (id_team), INDEX IDX_E2D38B2294DE8435 (id_match), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_test (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, street1 VARCHAR(255) DEFAULT NULL, street2 VARCHAR(255) DEFAULT NULL, postalcode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geo_code (id INT AUTO_INCREMENT NOT NULL, longitude NUMERIC(10, 8) DEFAULT NULL, latitude NUMERIC(10, 8) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, geo_code_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_5E9E89CBF5B7AF75 (address_id), UNIQUE INDEX UNIQ_5E9E89CB90CC7315 (geo_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, icon_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, category_id INT DEFAULT NULL, location_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, information VARCHAR(255) DEFAULT NULL, preview_text LONGTEXT NOT NULL, preview_picture LONGTEXT NOT NULL, working_time VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, site_url VARCHAR(255) NOT NULL, INDEX IDX_741D53CD98260155 (region_id), INDEX IDX_741D53CD12469DE2 (category_id), UNIQUE INDEX UNIQ_741D53CD64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_F62F176989D9B62 (slug), UNIQUE INDEX UNIQ_F62F17664D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, total NUMERIC(10, 10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, bill_id INT DEFAULT NULL, hotel_id INT NOT NULL, user_id INT NOT NULL, ticket_id INT NOT NULL, UNIQUE INDEX UNIQ_E00CEDDE1A8C12F5 (bill_id), INDEX IDX_E00CEDDE3243BB18 (hotel_id), INDEX IDX_E00CEDDEA76ED395 (user_id), INDEX IDX_E00CEDDE700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED998260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA32ABEACD6 FOREIGN KEY (match_id) REFERENCES `match` (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21E09543D4 FOREIGN KEY (id_team1) REFERENCES team (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21799C126E FOREIGN KEY (id_team2) REFERENCES team (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21E9B22F8 FOREIGN KEY (id_team3) REFERENCES team (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C2190FFB75B FOREIGN KEY (id_team4) REFERENCES team (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505E09543D4 FOREIGN KEY (id_team1) REFERENCES team_test (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505799C126E FOREIGN KEY (id_team2) REFERENCES team_test (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B224FC0BA1D FOREIGN KEY (id_team) REFERENCES team_test (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B2294DE8435 FOREIGN KEY (id_match) REFERENCES `match` (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB90CC7315 FOREIGN KEY (geo_code_id) REFERENCES geo_code (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD12469DE2 FOREIGN KEY (category_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F17664D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE1A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21E09543D4');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21799C126E');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21E9B22F8');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C2190FFB75B');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B3243BB18');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3243BB18');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE700047D2');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA32ABEACD6');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B2294DE8435');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505E09543D4');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505799C126E');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B224FC0BA1D');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBF5B7AF75');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB90CC7315');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED964D218E');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD64D218E');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F17664D218E');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD12469DE2');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED998260155');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD98260155');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE1A8C12F5');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE matche');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE team_test');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE geo_code');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE booking');
    }
}
