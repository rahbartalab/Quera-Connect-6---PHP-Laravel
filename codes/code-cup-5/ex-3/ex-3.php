<?php

use JetBrains\PhpStorm\NoReturn;

class JsonDB
{
    public function __construct(public string $rootDir = __DIR__)
    {
    }

    /**
     * @throws Exception
     */
    public function insert(string $tableName, array $data): void
    {
        $tablePath = "{$this->rootDir}/{$tableName}.json";

        if (!file_exists($tablePath)) {
            $this->logException("there is not table with name $tableName");
        }
        $tableData = json_decode(file_get_contents($tablePath), true);
        $schema = @$tableData['schema'];
        $records = @$tableData['data'] ?? [];

        if (!$schema) {
            $this->logException("table with name {$tableName} has no schema");
        }

        foreach ($schema as $key => $value) {
            if (!array_key_exists($key, $data) && !(@$value['nullable'])) {
                throw new Exception("No value provided for column {$key}");
            }
        }

        $insertPack = [];
        foreach ($data as $key => $value) {

            if (!array_key_exists($key, ($schema))) {
                $this->logException("Column {$key} not found");
            }

            $nullable = @$schema[$key]['nullable'] ?? false;
            if (is_null($value) && $nullable) {
                $insertPack[$key] = @$schema['default'];
            } else {
                $insertPack[$key] = $value;
            }
        }
        $records[] = $insertPack;
        $newData = [
            'schema' => $schema,
            'data' => $records
        ];

        file_put_contents($tablePath, json_encode($newData));

    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function logException(string $message): void
    {
        throw new Exception($message);
    }
}


$db = new JsonDB(__DIR__);
$db->insert('users', ['first_name' => 'Ali', 'last_name' => 'AliZadeh', 'country' => 'Iran']);

$db->insert('users', ['first_name' => 'Ali', 'last_name' => 'AliZadeh']);

$db->insert('users', ['last_name' => 'AliZadeh', 'country' => 'Iran']); // Exception: No value provided for column first_name
