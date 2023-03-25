<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230325134338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE prices (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, currency VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_sizes (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, price_id INT DEFAULT NULL, size VARCHAR(20) NOT NULL, INDEX IDX_17C2FC354584665A (product_id), INDEX IDX_17C2FC35D614C7E7 (price_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_sizes ADD CONSTRAINT FK_17C2FC354584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_sizes ADD CONSTRAINT FK_17C2FC35D614C7E7 FOREIGN KEY (price_id) REFERENCES prices (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_sizes DROP FOREIGN KEY FK_17C2FC354584665A');
        $this->addSql('ALTER TABLE product_sizes DROP FOREIGN KEY FK_17C2FC35D614C7E7');
        $this->addSql('DROP TABLE prices');
        $this->addSql('DROP TABLE product_sizes');
        $this->addSql('DROP TABLE products');
    }
}
