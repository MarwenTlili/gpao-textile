<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215152249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, composition LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_23A0E668947610D (designation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, valider TINYINT(1) NOT NULL, privilegier TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C74404556C6E55B5 (nom), UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, palette_id INT NOT NULL, nbr_articles INT DEFAULT NULL, INDEX IDX_470BDFF9908BC74 (palette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, trn VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date_production (id INT AUTO_INCREMENT NOT NULL, date_du_jour DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, date_recrutement DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe_presence (id INT AUTO_INCREMENT NOT NULL, employe_id INT NOT NULL, presence_id INT NOT NULL, heure_debut TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', heure_fin TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', INDEX IDX_266C3A9B1B65292 (employe_id), INDEX IDX_266C3A9BF328FFC4 (presence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, montant_totale NUMERIC(10, 3) DEFAULT NULL, factured_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ilot (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ilot_employe (id INT AUTO_INCREMENT NOT NULL, ilot_id INT NOT NULL, employe_id INT NOT NULL, date_debut DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', date_fin DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_F02DB4809A4BD21C (ilot_id), INDEX IDX_F02DB4801B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ilot_machine (id INT AUTO_INCREMENT NOT NULL, ilot_id INT NOT NULL, machine_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_1D2CB8BD9A4BD21C (ilot_id), INDEX IDX_1D2CB8BDF6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_fabrication (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, facture_id INT DEFAULT NULL, article_id INT NOT NULL, created_at DATETIME NOT NULL, qte_total INT NOT NULL, document_technique VARCHAR(255) DEFAULT NULL, temps_unitaire INT NOT NULL, prix_unitaire NUMERIC(10, 3) NOT NULL, montant NUMERIC(10, 3) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, urgent TINYINT(1) DEFAULT \'0\' NOT NULL, lancer TINYINT(1) DEFAULT \'0\' NOT NULL, refuser TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_7FB222D219EB6921 (client_id), INDEX IDX_7FB222D27F2DEE08 (facture_id), INDEX IDX_7FB222D27294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_fabrication_taille (id INT AUTO_INCREMENT NOT NULL, ordre_fabrication_id INT NOT NULL, taille_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_A00031546A91B091 (ordre_fabrication_id), INDEX IDX_A0003154FF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE palette (id INT AUTO_INCREMENT NOT NULL, ordre_fabrication_id INT NOT NULL, client_id INT NOT NULL, qte_totale_articles INT DEFAULT NULL, INDEX IDX_C7E5A77E6A91B091 (ordre_fabrication_id), INDEX IDX_C7E5A77E19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_hebdomadaire (id INT AUTO_INCREMENT NOT NULL, ilot_id INT NOT NULL, ordre_fabrication_id INT NOT NULL, start_at DATE NOT NULL, end_at DATE NOT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_1A925CBC9A4BD21C (ilot_id), UNIQUE INDEX UNIQ_1A925CBC6A91B091 (ordre_fabrication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, date_jour DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_journalier (id INT AUTO_INCREMENT NOT NULL, date_production_id INT NOT NULL, ilot_id INT NOT NULL, planning_hebdomadaire_id INT NOT NULL, quantite_premiere_choix INT NOT NULL, quantite_deuxieme_choix INT NOT NULL, INDEX IDX_59A84FE697F86536 (date_production_id), INDEX IDX_59A84FE69A4BD21C (ilot_id), INDEX IDX_59A84FE6A20A226E (planning_hebdomadaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, nom ENUM(\'L\', \'M\', \'XL\'), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF9908BC74 FOREIGN KEY (palette_id) REFERENCES palette (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employe_presence ADD CONSTRAINT FK_266C3A9B1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE employe_presence ADD CONSTRAINT FK_266C3A9BF328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id)');
        $this->addSql('ALTER TABLE ilot_employe ADD CONSTRAINT FK_F02DB4809A4BD21C FOREIGN KEY (ilot_id) REFERENCES ilot (id)');
        $this->addSql('ALTER TABLE ilot_employe ADD CONSTRAINT FK_F02DB4801B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE ilot_machine ADD CONSTRAINT FK_1D2CB8BD9A4BD21C FOREIGN KEY (ilot_id) REFERENCES ilot (id)');
        $this->addSql('ALTER TABLE ilot_machine ADD CONSTRAINT FK_1D2CB8BDF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE ordre_fabrication ADD CONSTRAINT FK_7FB222D219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE ordre_fabrication ADD CONSTRAINT FK_7FB222D27F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE ordre_fabrication ADD CONSTRAINT FK_7FB222D27294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE ordre_fabrication_taille ADD CONSTRAINT FK_A00031546A91B091 FOREIGN KEY (ordre_fabrication_id) REFERENCES ordre_fabrication (id)');
        $this->addSql('ALTER TABLE ordre_fabrication_taille ADD CONSTRAINT FK_A0003154FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE palette ADD CONSTRAINT FK_C7E5A77E6A91B091 FOREIGN KEY (ordre_fabrication_id) REFERENCES ordre_fabrication (id)');
        $this->addSql('ALTER TABLE palette ADD CONSTRAINT FK_C7E5A77E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE planning_hebdomadaire ADD CONSTRAINT FK_1A925CBC9A4BD21C FOREIGN KEY (ilot_id) REFERENCES ilot (id)');
        $this->addSql('ALTER TABLE planning_hebdomadaire ADD CONSTRAINT FK_1A925CBC6A91B091 FOREIGN KEY (ordre_fabrication_id) REFERENCES ordre_fabrication (id)');
        $this->addSql('ALTER TABLE production_journalier ADD CONSTRAINT FK_59A84FE697F86536 FOREIGN KEY (date_production_id) REFERENCES date_production (id)');
        $this->addSql('ALTER TABLE production_journalier ADD CONSTRAINT FK_59A84FE69A4BD21C FOREIGN KEY (ilot_id) REFERENCES ilot (id)');
        $this->addSql('ALTER TABLE production_journalier ADD CONSTRAINT FK_59A84FE6A20A226E FOREIGN KEY (planning_hebdomadaire_id) REFERENCES planning_hebdomadaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordre_fabrication DROP FOREIGN KEY FK_7FB222D27294869C');
        $this->addSql('ALTER TABLE ordre_fabrication DROP FOREIGN KEY FK_7FB222D219EB6921');
        $this->addSql('ALTER TABLE palette DROP FOREIGN KEY FK_C7E5A77E19EB6921');
        $this->addSql('ALTER TABLE production_journalier DROP FOREIGN KEY FK_59A84FE697F86536');
        $this->addSql('ALTER TABLE employe_presence DROP FOREIGN KEY FK_266C3A9B1B65292');
        $this->addSql('ALTER TABLE ilot_employe DROP FOREIGN KEY FK_F02DB4801B65292');
        $this->addSql('ALTER TABLE ordre_fabrication DROP FOREIGN KEY FK_7FB222D27F2DEE08');
        $this->addSql('ALTER TABLE ilot_employe DROP FOREIGN KEY FK_F02DB4809A4BD21C');
        $this->addSql('ALTER TABLE ilot_machine DROP FOREIGN KEY FK_1D2CB8BD9A4BD21C');
        $this->addSql('ALTER TABLE planning_hebdomadaire DROP FOREIGN KEY FK_1A925CBC9A4BD21C');
        $this->addSql('ALTER TABLE production_journalier DROP FOREIGN KEY FK_59A84FE69A4BD21C');
        $this->addSql('ALTER TABLE ilot_machine DROP FOREIGN KEY FK_1D2CB8BDF6B75B26');
        $this->addSql('ALTER TABLE ordre_fabrication_taille DROP FOREIGN KEY FK_A00031546A91B091');
        $this->addSql('ALTER TABLE palette DROP FOREIGN KEY FK_C7E5A77E6A91B091');
        $this->addSql('ALTER TABLE planning_hebdomadaire DROP FOREIGN KEY FK_1A925CBC6A91B091');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF9908BC74');
        $this->addSql('ALTER TABLE production_journalier DROP FOREIGN KEY FK_59A84FE6A20A226E');
        $this->addSql('ALTER TABLE employe_presence DROP FOREIGN KEY FK_266C3A9BF328FFC4');
        $this->addSql('ALTER TABLE ordre_fabrication_taille DROP FOREIGN KEY FK_A0003154FF25611A');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE date_production');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE employe_presence');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE ilot');
        $this->addSql('DROP TABLE ilot_employe');
        $this->addSql('DROP TABLE ilot_machine');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE ordre_fabrication');
        $this->addSql('DROP TABLE ordre_fabrication_taille');
        $this->addSql('DROP TABLE palette');
        $this->addSql('DROP TABLE planning_hebdomadaire');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE production_journalier');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE user');
    }
}
