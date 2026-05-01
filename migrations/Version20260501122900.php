<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501122900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787089312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870D3EB8572 FOREIGN KEY (unitee_id) REFERENCES unitee (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1489312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE recette DROP isnew');
        $this->addSql('ALTER TABLE recette_categorie_recette ADD CONSTRAINT FK_319D227989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_categorie_recette ADD CONSTRAINT FK_319D227917F8E545 FOREIGN KEY (categorie_recette_id) REFERENCES categorie_recette (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1489312FE9');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE recette ADD isnew TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787089312FE9');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870F347EFB');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870D3EB8572');
        $this->addSql('ALTER TABLE recette_categorie_recette DROP FOREIGN KEY FK_319D227989312FE9');
        $this->addSql('ALTER TABLE recette_categorie_recette DROP FOREIGN KEY FK_319D227917F8E545');
    }
}
