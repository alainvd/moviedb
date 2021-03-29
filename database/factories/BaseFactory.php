<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * Base factory abstract class for common functionality among factories
 */
abstract class BaseFactory extends Factory
{
    /**
     * Get a relation id if exists, or factory
     */
    protected function getRelationId($model)
    {
        return $this->getRelation($model)->id;
    }

    protected function getRelation($model)
    {
        $model = new $model;

        if (!$model instanceof Model) {
            throw new Exception("Provided {$model} is not an Eloquent model instance");
        }

        if ($model->all()->count() > 0) {
            return $model->all()->random();
        } else {
            return $model->factory()->create();
        }
    }
}
