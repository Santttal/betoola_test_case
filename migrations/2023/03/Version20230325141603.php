<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325141603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO products (id, name, category) VALUES (1, 'bracelet', 'Jewelry');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (1, 'Small');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (1, 'Medium');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (1, 'Large');");

        $this->addSql("INSERT INTO products (id, name, category) VALUES (2, 'red shoes', 'Shoes');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (2, '38');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (2, '39');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (2, '40');");
        $this->addSql("INSERT INTO product_sizes (product_id, size) VALUES (2, '41');");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE products');
        $this->addSql('TRUNCATE TABLE product_sizes');
    }
}
