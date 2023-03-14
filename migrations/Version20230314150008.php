<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314150008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, vendeur_id INT NOT NULL, libelle_article VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, qte_produit INT NOT NULL, prix DOUBLE PRECISION NOT NULL, image_article VARCHAR(255) NOT NULL, nb_commentaire INT DEFAULT NULL, INDEX IDX_23A0E66BCF5E72D (categorie_id), INDEX IDX_23A0E66858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, auteur_id INT NOT NULL, contenu_commentaire VARCHAR(255) NOT NULL, INDEX IDX_67F068BC7294869C (article_id), INDEX IDX_67F068BC60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retrait (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, numero_rue INT NOT NULL, complement_adresse VARCHAR(255) DEFAULT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_retrait (utilisateur_id INT NOT NULL, retrait_id INT NOT NULL, INDEX IDX_A38F9DC3FB88E14F (utilisateur_id), INDEX IDX_A38F9DC37EF8457A (retrait_id), PRIMARY KEY(utilisateur_id, retrait_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_article (utilisateur_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_7831F9F4FB88E14F (utilisateur_id), INDEX IDX_7831F9F47294869C (article_id), PRIMARY KEY(utilisateur_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66858C065E FOREIGN KEY (vendeur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_retrait ADD CONSTRAINT FK_A38F9DC3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_retrait ADD CONSTRAINT FK_A38F9DC37EF8457A FOREIGN KEY (retrait_id) REFERENCES retrait (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_article ADD CONSTRAINT FK_7831F9F4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_article ADD CONSTRAINT FK_7831F9F47294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD nom_prenom VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, ADD credit DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66858C065E');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC60BB6FE6');
        $this->addSql('ALTER TABLE utilisateur_retrait DROP FOREIGN KEY FK_A38F9DC3FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_retrait DROP FOREIGN KEY FK_A38F9DC37EF8457A');
        $this->addSql('ALTER TABLE utilisateur_article DROP FOREIGN KEY FK_7831F9F4FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_article DROP FOREIGN KEY FK_7831F9F47294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE retrait');
        $this->addSql('DROP TABLE utilisateur_retrait');
        $this->addSql('DROP TABLE utilisateur_article');
        $this->addSql('ALTER TABLE utilisateur DROP nom_prenom, DROP is_verified, DROP avatar, DROP credit');
    }
}
