<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021150149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE order_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE order_product (id INT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2530ADE6FCDAEAAA ON order_product (order_id_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6DE18E50B ON order_product (product_id_id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE order_product_id_seq CASCADE');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT FK_2530ADE6FCDAEAAA');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT FK_2530ADE6DE18E50B');
        $this->addSql('DROP TABLE order_product');
    }
}
