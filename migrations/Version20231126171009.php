<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126171009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, precio DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, curso_id INT NOT NULL, usuario VARCHAR(255) NOT NULL, comentario LONGTEXT NOT NULL, valoracion INT NOT NULL, INDEX IDX_AB02B02787CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02787CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');

        //insertar datos en tablas
        $this->addSql('INSERT INTO curso (id, titulo, descripcion, precio) VALUES (1, "Introducción a Synfony", "Este curso recoge los primeros pasos que debe dar un programador en Synfony.", 154.95)');
        $this->addSql('INSERT INTO curso (id, titulo, descripcion, precio) VALUES (2, "¿Por qué contratar a Nicolás Torre?", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", 201.50)');
        $this->addSql('INSERT INTO opinion (curso_id, usuario, comentario, valoracion) VALUES (1, "Fran", "Gracias a este curso tengo un nuevo trabajo.", 4)');
        $this->addSql('INSERT INTO opinion (curso_id, usuario, comentario, valoracion) VALUES (1, "Héctor", "Pensé que era un curso musical. Decepcionado.", 1)');
        $this->addSql('INSERT INTO opinion (curso_id, usuario, comentario, valoracion) VALUES (2, "Nico", "¿Y por qué no?", 5)');
        $this->addSql('INSERT INTO opinion (curso_id, usuario, comentario, valoracion) VALUES (2, "Pepe", "No esta nada mal.", 5)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02787CB4A1F');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE opinion');
    }
}
