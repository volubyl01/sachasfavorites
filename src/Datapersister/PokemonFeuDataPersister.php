<?php 
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Product; // Importez votre entité
use Doctrine\ORM\EntityManagerInterface;

final class PokemonFeuDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        // Vérifiez que $data est une instance de Product
        return $data instanceof Poke;
    }

    public function persist($data, array $context = [])
    {
        // Logique pour persister $data
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }

    public function remove($data, array $context = [])
    {
        // Logique pour supprimer $data
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
