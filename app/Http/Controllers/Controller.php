<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

use function Ramsey\Uuid\v1;

abstract class Controller
{
    protected static string $model;

    const DEFAULT_STORE_MESSAGE   = 'stored successfully';
    const DEFAULT_UPDATE_MESSAGE  = 'updated successfully';
    const DEFAULT_DESTROY_MESSAGE = 'deleted successfully';
    const DEFAULT_SHOW_MESSAGE    = 'found successfully';

    /**
     * Get the value of model
     *
     * @return string
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-05-11
     */
    public static function getModel(): string
    {
        $model = self::getModelName();
        self::$model = "App\\Models\\$model";
        return static::$model;
    }

    private static function getModelName(): string
    {
        $model = static::class;
        $model = explode('\\', $model);
        $model = end($model);
        $model = str_replace('Controller', '', $model);

        return ucfirst($model);
    }

    /**
     * Get all records from the model
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    public static function index(Request $request): Response|ResponseFactory
    {
        try
        {
            $builder = static::makeCustomFilter($request);

            $objects = $builder->orderBy('id')->get();

            return ApiService::response($objects->toArray());
        }
        catch (Exception $e)
        {
            return ApiService::responseError($e, $e->getCode());
        }
    }

    /**
     * Get a record from the model
     *
     * @param integer|string $id
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    public static function show(int|string $id):Response|ResponseFactory
    {
        try
        {
            $object = (static::getModel())::query()->findOrFail($id);

            return ApiService::response($object, __(':model ' . self::DEFAULT_SHOW_MESSAGE, ['model' => self::getModelName()]));
        }
        catch (Exception $e)
        {
            return ApiService::responseError($e, 404);
        }
    }

    /**
     * Store a new record in the model
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    public static function store(Request $request): Response|ResponseFactory
    {
        try
        {
            $model = new (static::getModel())();

            static::fillWithRequest($model, $request);

            $object = static::returnOrException($model, $model->save(), 'salvar');

            return ApiService::response($object, __(':model ' . self::DEFAULT_STORE_MESSAGE, ['model' => self::getModelName()]));
        }
        catch (Exception $e)
        {
            return ApiService::responseError($e, $e->getCode());
        }
    }

    /**
     * Update a record in the model
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    public static function update(Request $request, int $id): Response|ResponseFactory
    {
        try
        {
            $model = (static::getModel())::query()->findOrFail($id);

            static::fillWithRequest($model, $request);

            $object = static::returnOrException($model, $model->save(), 'atualizar');

            return ApiService::response($object, __(':model ' . self::DEFAULT_UPDATE_MESSAGE, ['model' => self::getModelName()]));
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete a record in the model
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    public static function destroy(int $id): Response|ResponseFactory
    {
        try
        {
            $model = (static::getModel())::query()->findOrFail($id);

            // TODO: Futuramente não excluir, mas sim desativar, adicionar timestamps
            $object = static::returnOrException($model, $model->save(), 'deletar');

            $object->deleteOrFail();

            return ApiService::response($object, __(':model ' . self::DEFAULT_DESTROY_MESSAGE, ['model' => self::getModelName()]));
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Fill the model with the request data
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    private static function fillWithRequest(Model &$model, Request $request): Model
    {
        foreach ($model->getFillable() as $field)
        {
            if ($request->has($field))
            {
                $model->$field = $request->$field;
            }
        }
        return $model;
    }

    /**
     * Return the model or throw an exception
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param boolean $actionResult
     * @param string $action
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    private static function returnOrException(Model $model, bool $actionResult, string $action): Model
    {
        if ($actionResult)
        {
            return $model;
        }

        throw new \Exception('Erro ao' . $action . ' ' . $model->getTable());
    }


    /**
     * Make a custom filter in the model
     *
     * @param  Request      $request
     * @param  Builder|null $builder
     *
     * @return Builder
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-05-11
     */
    private static function makeCustomFilter(Request $request, ?Builder $builder = NULL): Builder
    {
        if (!$builder)
        {
            $builder = (static::getModel())::query();
        }

        if (!empty($request->query()))
        {
            $model = new (static::getModel());
            // $modelColumns = Schema::getColumnListing($model->getTable());
            $modelColumns = $model->getFillable();
            $modelColumns[] = 'id';

            foreach ($request->query() as $key => $value)
            {
                $valueIsJson = is_array(json_decode(urldecode($value), true)) && (json_last_error() == JSON_ERROR_NONE); 

                if($valueIsJson){
                    $hasRelation = method_exists($model, $key);
                    if ($hasRelation) {
                        $value = json_decode(urldecode($value), true);
                        $builder->with([$key => function($query) use ($value) {
                            foreach ($value as $key => $val) {
                                $query->where($key, $val);
                            }
                        }]);
                    }
                    continue;
                }
                elseif (in_array($key, $modelColumns) && !empty($value)) {
                    if (is_numeric($value)) {
                        $builder->where($key, $value);
                    } elseif (is_string($value)) {
                        $builder->where($key, 'ilike', "%$value%");
                    } else {
                        $builder->where($key, $value);
                    }
                }
            }
        }

        $limit  = $request->query('limit', 100);
        $offset = $request->query('offset', 0);

        $builder->limit($limit)->offset($offset);

        return $builder;
    }
}