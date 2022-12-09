<?php

namespace App\Classifiers;

use Wnx\LaravelStats\Contracts\Classifier;
use Wnx\LaravelStats\ReflectionClass;

class Transformer implements Classifier
{
    public function name(): string
    {
        return 'Transformers';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(\League\Fractal\TransformerAbstract::class);
    }

    public function countsTowardsApplicationCode(): bool
    {
        return true;
    }

    public function countsTowardsTests(): bool
    {
        return false;
    }
}
