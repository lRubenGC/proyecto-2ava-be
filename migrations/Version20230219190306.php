<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219190306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_car (user_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_9C2B8716A76ED395 (user_id), INDEX IDX_9C2B8716C3C6F69F (car_id), PRIMARY KEY(user_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_car ADD CONSTRAINT FK_9C2B8716A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_car ADD CONSTRAINT FK_9C2B8716C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_car DROP FOREIGN KEY FK_9C2B8716A76ED395');
        $this->addSql('ALTER TABLE user_car DROP FOREIGN KEY FK_9C2B8716C3C6F69F');
        $this->addSql('DROP TABLE user_car');
    }
}
