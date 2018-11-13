<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181113203243 extends AbstractMigration
{

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('
            INSERT INTO `members`
              (`username`, `password`, `display_name`)
            VALUES
              ("admin@example.com","$2y$12$fn5V32AqVjgPHR1AVLf5oeRvpLnd8VAWVuVU1KsLvvg.mJMUp29fa", "John Doe")
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DELETE FROM `members` WHERE `username` = "admin@example.com"');
    }
}
