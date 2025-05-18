<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250516140030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_pub_id INT DEFAULT NULL, contenu VARCHAR(500) NOT NULL, date_commentaire DATETIME NOT NULL, INDEX IDX_67F068BC79F37AE5 (id_user_id), INDEX IDX_67F068BCA5CA559A (id_pub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, contenu VARCHAR(10000) NOT NULL, date_pub DATETIME NOT NULL, INDEX IDX_AF3C677979F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reaction (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_pub_id INT DEFAULT NULL, type_react VARCHAR(255) NOT NULL, date_react DATETIME NOT NULL, UNIQUE INDEX UNIQ_A4D707F779F37AE5 (id_user_id), INDEX IDX_A4D707F7A5CA559A (id_pub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, id_tag INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA5CA559A FOREIGN KEY (id_pub_id) REFERENCES publication (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication ADD CONSTRAINT FK_AF3C677979F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F779F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7A5CA559A FOREIGN KEY (id_pub_id) REFERENCES publication (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC79F37AE5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA5CA559A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677979F37AE5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F779F37AE5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7A5CA559A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE commentaire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE publication
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reaction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
    }
}
