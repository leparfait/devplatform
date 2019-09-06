<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906105902 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, date DATE NOT NULL, description LONGTEXT DEFAULT NULL, competence LONGTEXT NOT NULL, institut VARCHAR(255) DEFAULT NULL, INDEX IDX_EB4C4D4EFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D8698A7682F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) DEFAULT NULL, date_nais DATE DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, pays VARCHAR(100) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E6D6B2979D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, poste VARCHAR(255) NOT NULL, debut DATETIME NOT NULL, fin DATETIME DEFAULT NULL, entreprise VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, actuelposte TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_590C103FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_video (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, identif VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meslanguage (id INT AUTO_INCREMENT NOT NULL, language_id_id INT NOT NULL, utilisateur_id INT NOT NULL, niveau VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_BFDEF42B1C9A06 (language_id_id), INDEX IDX_BFDEF42BFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, intiateur_id INT NOT NULL, description LONGTEXT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_50159CA9F6B5EEAB (intiateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet_profil (projet_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_C47F02C1C18272 (projet_id), INDEX IDX_C47F02C1275ED078 (profil_id), PRIMARY KEY(projet_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projetrealiser (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, datedebut DATETIME NOT NULL, datefin DATETIME NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_8DC9310BFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, explication VARCHAR(255) DEFAULT NULL, degre INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_4B98C215E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_user (groupe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_257BA9FE7A45358C (groupe_id), INDEX IDX_257BA9FEA76ED395 (user_id), PRIMARY KEY(groupe_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inviter (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, profil_id INT NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langprog (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7682F1BAF4 FOREIGN KEY (language_id) REFERENCES langprog (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2979D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE meslanguage ADD CONSTRAINT FK_BFDEF42B1C9A06 FOREIGN KEY (language_id_id) REFERENCES langprog (id)');
        $this->addSql('ALTER TABLE meslanguage ADD CONSTRAINT FK_BFDEF42BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9F6B5EEAB FOREIGN KEY (intiateur_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE projet_profil ADD CONSTRAINT FK_C47F02C1C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_profil ADD CONSTRAINT FK_C47F02C1275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projetrealiser ADD CONSTRAINT FK_8DC9310BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE groupe_user ADD CONSTRAINT FK_257BA9FE7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_user ADD CONSTRAINT FK_257BA9FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4EFB88E14F');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103FB88E14F');
        $this->addSql('ALTER TABLE meslanguage DROP FOREIGN KEY FK_BFDEF42BFB88E14F');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9F6B5EEAB');
        $this->addSql('ALTER TABLE projet_profil DROP FOREIGN KEY FK_C47F02C1275ED078');
        $this->addSql('ALTER TABLE projetrealiser DROP FOREIGN KEY FK_8DC9310BFB88E14F');
        $this->addSql('ALTER TABLE projet_profil DROP FOREIGN KEY FK_C47F02C1C18272');
        $this->addSql('ALTER TABLE groupe_user DROP FOREIGN KEY FK_257BA9FE7A45358C');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7682F1BAF4');
        $this->addSql('ALTER TABLE meslanguage DROP FOREIGN KEY FK_BFDEF42B1C9A06');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2979D86650F');
        $this->addSql('ALTER TABLE groupe_user DROP FOREIGN KEY FK_257BA9FEA76ED395');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE media_video');
        $this->addSql('DROP TABLE meslanguage');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE projet_profil');
        $this->addSql('DROP TABLE projetrealiser');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_user');
        $this->addSql('DROP TABLE inviter');
        $this->addSql('DROP TABLE langprog');
        $this->addSql('DROP TABLE user');
    }
}
