<?php

namespace App\Classifiers;

use Wnx\LaravelStats\Contracts\Classifier;
use Wnx\LaravelStats\ReflectionClass;

class Import implements Classifier
{
    public function name(): string
    {
        return 'Imports';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(\App\Abstracts\Import::class);
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
