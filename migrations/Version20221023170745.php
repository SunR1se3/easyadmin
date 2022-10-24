<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023170745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orders (id INT NOT NULL, sum DOUBLE PRECISION NOT NULL, status INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE products (id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE products_orders (products_id INT NOT NULL, orders_id INT NOT NULL, PRIMARY KEY(products_id, orders_id))');
        $this->addSql('CREATE INDEX IDX_631C76C46C8A81A9 ON products_orders (products_id)');
        $this->addSql('CREATE INDEX IDX_631C76C4CFFE9AD6 ON products_orders (orders_id)');
        $this->addSql('ALTER TABLE products_orders ADD CONSTRAINT FK_631C76C46C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_orders ADD CONSTRAINT FK_631C76C4CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE products_id_seq CASCADE');
        $this->addSql('ALTER TABLE products_orders DROP CONSTRAINT FK_631C76C46C8A81A9');
        $this->addSql('ALTER TABLE products_orders DROP CONSTRAINT FK_631C76C4CFFE9AD6');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE products_orders');
    }
}
