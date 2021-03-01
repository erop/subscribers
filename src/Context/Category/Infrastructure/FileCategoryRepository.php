<?php

declare(strict_types=1);

namespace App\Context\Category\Infrastructure;


use App\Context\Category\Domain\Category;
use App\Context\Category\Domain\CategoryId;
use App\Context\Category\Domain\ICategoryRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class FileCategoryRepository implements ICategoryRepository
{
    private const DATA_FILE = 'categories.csv';

    private string $storageDir;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->storageDir = $parameterBag->get('kernel.project_dir') . DIRECTORY_SEPARATOR . 'storage';
        if ( ! is_dir($this->storageDir)) {
            if ( ! mkdir($concurrentDirectory = $this->storageDir, 0777, true) && ! is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
    }

    public function save(Category $category): void
    {
        $dataFile = $this->buildPath(self::DATA_FILE);
        file_put_contents($dataFile, \serialize($category) . PHP_EOL, FILE_APPEND);
    }

    private function buildPath(string $fileName): string
    {
        return $this->storageDir . DIRECTORY_SEPARATOR . $fileName;
    }

    public function find(CategoryId $id): ?Category
    {
        return $this->findOneBy(['id' => $id->value()]);
    }

    public function findOneBy(array $criteria): ?Category
    {
        $categories = $this->findBy($criteria);
        if (0 === count($categories)) {
            return null;
        }
        return $categories[0];
    }

    public function findBy(array $criteria): array
    {
        $result = [];
        foreach ($this->findAll() as $category) {
            if ($this->categoryMatches($category, $criteria)) {
                $result[] = $category;
            }
        }
        return $result;
    }

    public function findAll(): array
    {
        $dataFile = $this->buildPath(self::DATA_FILE);
        if ( ! is_file($dataFile)) {
            touch($dataFile);
        }
        $data = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return array_map(
            static function (string $serialized): Category {
                return \unserialize($serialized, ['allowed_classes' => [Category::class]]);
            },
            $data
        );
    }

    private function categoryMatches(Category $category, array $criteria): bool
    {
        $state = $category->getState();
        $result = true;
        foreach ($criteria as $key => $value) {
            $result = $result && ($state[$key] === $value);
            if (false === $result) {
                return false;
            }
        }
        return true;
    }
}