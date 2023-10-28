<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionMethod;

abstract class QueryFilters
{
    /**
     * The loose query condition.
     */
    public $loose = [];

    /**
     * The request object.
     *
     * @var Request
     */
    public $request;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Loose comparison key.
     */
    private const LOOSE_KEY = 'loose';

    /**
     * Create a new QueryFilters instance.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = new Request($request->input());
    }

    /**
     * Creates a new instance with the specified filters.
     *
     * @param array $filters
     *
     * @return static
     */
    public static function make(array $filters = [])
    {
        return new static(new Request($filters));
    }

    /**
     * Apply the filters to the builder.
     *
     * @param Builder $builder
     * @param array   $defaults
     *
     * @return Builder
     */
    public function apply(Builder $builder, $defaults = [])
    {
        $this->validate();
        $this->builder = $builder;
        $this->looseComparison();

        foreach ($this->filters() as $name => $value) {
            if (!method_exists($this, $name)) {
                continue;
            }

            if (!is_array($value) && strlen($value)) {
                $this->$name($value);
            } elseif (is_array($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        if (!empty($defaults)) {
            $this->applyDefaults($defaults);
        }

        return $this->builder;
    }

    /**
     * Apply default filters to the builder.
     *
     * @param array $defaults
     *
     * @return void
     */
    public function applyDefaults($defaults)
    {
        foreach ($defaults as $filter => $value) {
            if (!array_key_exists($filter, $this->filters()) && $filter !== self::LOOSE_KEY) {
                $this->$filter($value);
            }
        }
    }

    /**
     * Get all request filters data.
     *
     * @return array
     */
    public function filters()
    {
        $keys = $this->getFilterMethods();

        return $this->request->only($keys);
    }

    /**
     * Get all the available filter methods.
     *
     * @return array
     */
    protected function getFilterMethods()
    {
        $class = new ReflectionClass(static::class);

        $methods = array_map(function ($method) use ($class) {
            if ($method->class === $class->getName()) {
                return $method->name;
            }

            return null;
        }, $class->getMethods(ReflectionMethod::IS_PUBLIC));

        return array_filter($methods);
    }

    protected function strToArray($params)
    {
        if (is_array($params)) {
            return $params;
        }

        return array_map(function ($word) {
            return trim($word);
        }, array_filter(explode(',', $params)));
    }

    /**
     * Update loose query comparition list.
     *
     * @return void
     */
    protected function looseComparison()
    {
        $list = $this->request->only(self::LOOSE_KEY);

        if (!empty($list)) {
            $this->loose = array_filter(array_map(function ($item) {
                return trim($item);
            }, explode(',', $list[self::LOOSE_KEY])));
        }
    }

    protected function isLoose()
    {
        $bt = debug_backtrace();
        $method = $bt[1]['function'];

        return in_array($method, $this->loose);
    }

    private function validate()
    {
        $rules = $this->rules();

        if (!empty($rules)) {
            $this->request->validate($rules);
        }
    }

    protected function rules(): array
    {
        return [];
    }
}