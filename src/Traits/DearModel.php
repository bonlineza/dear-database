<?php

namespace Bonlineza\DearDatabase\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Throwable;

trait DearModel
{
    public static $MANY_TO_MANY = "MANY_TO_MANY";
    public static $MANY_TO_ONE = "MANY_TO_ONE";

    abstract public static function getDearMapping(): array;

    protected function getDearRelationships(): array
    {
        return [];
    }

    public static function getDearFieldTypes(): array
    {
        return [];
    }

    public function updateFromDear(array $fields): self
    {
        $this->createFromDear($fields, $this);
        return $this;
    }

    /**
     * @param array $fields
     * @param ?self $object
     * @return self
     */
    public static function createFromDear($fields, ?self $object = null): self
    {
        DB::beginTransaction();
        try {
            $mapped_data = self::mapFromDear($fields);

            if (empty($mapped_data)) {
                throw new \Exception(sprintf('Failed to map data from dear for class %s', self::class));
            }

            if (!$object) {
                $object = self::create($mapped_data);
            } else {
                $object->update($mapped_data);
            }
            if (!empty($object->getDearRelationships())) {
                $object->createFromDearWithRelationships($fields, $object);
            }
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollback();
            throw $exception;
        }
        return $object->refresh();
    }

    /** @psalm-suppress PossiblyUnusedMethod */
    public static function createManyFromDear($items)
    {
        $objects = [];
        foreach ($items as $fields) {
            $objects[] = self::createFromDear($fields);
        }

        return $objects;
    }

    /**
     * @param $dear_object
     * @param $dear_db_object
     * @return self
     */
    public function createFromDearWithRelationships($dear_object, $dear_db_object)
    {

        if (!empty($this->getDearRelationships())) {
            $relationship_values = [];

            foreach ($this->getDearRelationships() as $value) {
                if (!isset($dear_object[$value['dear_key']])) {
                    continue;
                }
                if (!isset($value['model'])) {
                    throw new \Exception(sprintf('Dear relationship model for table %s must be a valid class string', $value['table']));
                }

                $model = $value['model'];
                $data = null;
                $column = null;
                switch ($value['relationship_type']) {
                    case self::$MANY_TO_ONE:
                        $data = $model::createFromDear($dear_object[$value['dear_key']]);
                        $column = isset($value['column']) ? $value['column'] : null;
                        break;
                    case self::$MANY_TO_MANY:
                        $data = $model::createManyFromDear($dear_object[$value['dear_key']]);
                        break;
                }

                $relationship_values[$value['table']] = [
                    'data' => $data,
                    'relationship_type' => $value['relationship_type'],
                    'column' => $column,
                    'model' => $model,
                ];
            }

            foreach ($relationship_values as $key => $value) {
                switch ($value['relationship_type']) {
                    case self::$MANY_TO_ONE:
                        $var_key = $value['column'] ? $value['column'] : Pluralizer::singular($key) . '_id';
                        // Store old relationship id
                        $old_id = $this->$var_key;
                        // Set new relationship id
                        if (isset($value['data'])) {
                            $this->$var_key = $value['data']->id;
                        }
                        // Delete old relationship model
                        $value['model']::where('id', $old_id)->delete();
                        break;
                    case self::$MANY_TO_MANY:
                        $camel_case_key = Str::camel($key);
                        $old_ids = $this->$camel_case_key()->pluck($key . '.id');
                        // Unsync relationships to prevent foreign key constraint
                        $this->$camel_case_key()->sync([]);
                        // Delete the old relationships
                        $value['model']::whereIn('id', $old_ids)->delete();
                        // Sync the newly created relationships
                        $this->$camel_case_key()->sync(collect($value['data'])->pluck('id'));
                        break;
                }
            }
        }
        $this->save();

        return $dear_db_object->refresh();
    }

    public static function mapFromDear($fields): array
    {
        $mapped_data = [];
        foreach ($fields as $key => $item) {
            if (isset(self::getDearMapping()[$key])) {
                if (array_key_exists($key, self::getDearFieldTypes())) {
                    if (self::getDearFieldTypes()[$key] === 'date' && $item) {
                        $item = Carbon::parse($item)->format('Y-m-d H:i:s');
                    }
                }

                $mapped_data[self::getDearMapping()[$key]] = $item;
            }
        }
        return $mapped_data;
    }

    public function mapObjectToDear()
    {
        $mapped_data = [];
        foreach (self::getDearMapping() as $dear_key => $attribute) {
            if (isset($this[$attribute])) {
                $mapped_data[$dear_key] = $this[$attribute];
            }
        }
        return $mapped_data;
    }

    /**
     * Map database object and its relationships to dear format
     *
     * @return array
     */
    public function mapObjectToDearWithRelationships()
    {
        $mapped_data = [];
        foreach (self::getDearMapping() as $dear_key => $attribute) {
            $mapped_data[$dear_key] = $this[$attribute];
        }
        if (!empty($this->dear_relationships)) {
            foreach ($this->dear_relationships as $key => $value) {
                $dear_key = $value['dear_key'];
                switch ($value['relationship_type']) {
                    case self::$MANY_TO_ONE:
                        $db_object_column = Pluralizer::singular($value['table']);
                        $model = $this->$db_object_column;
                        $mapped_data[$dear_key] = $model ? $model->mapObjectToDearWithRelationships() : [];
                        break;
                    case self::$MANY_TO_MANY:
                        $table = $value['table'];
                        $camel_case_key = Str::camel($table);
                        $models = $this->$camel_case_key->sortBy('id');
                        $mapped_data[$dear_key] = [];
                        foreach ($models as $model) {
                            $mapped_data[$dear_key][] = $model->mapObjectToDearWithRelationships();
                        }
                        break;
                }
            }
        }
        return $mapped_data;
    }
}
