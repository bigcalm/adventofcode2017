<?php

namespace Day7;

use Day7\Program;
use PuzzleInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Schema\Blueprint;

class Puzzle1 implements PuzzleInterface
{
    protected $capsule;
    protected $connection;

    public function __construct(array $options = [])
    {
        // no options to manage

        if (!file_exists(__DIR__ . '/database.sqlite')) {
            touch(__DIR__ . '/database.sqlite');
        }

        $this->capsule = new Capsule;

        // Same as database configuration file of Laravel.
        $this->capsule->addConnection([
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/database.sqlite',
            'prefix'   => '',
        ], 'default');

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();

        // Hold a reference to established connection just in case.
        $this->connection = $this->capsule->getConnection('default');
    }

    public function processInput(string $input): string
    {
        $data = $this->parseString($input);

        $this->createDatabaseTables();
        $this->populateDatabase($data);
        $this->establishRelationships($data);

        $result = $this->getRootProgram()->id;

        return $result;
    }

    public function parseString(string $input): array
    {
        $data = [];

        $lines = preg_split("/\n/", trim($input));

        foreach ($lines as $line) {
            $data[] = $this->convertInputStringToComponentParts($line);
        }

        return $data;
    }

    public function convertInputStringToComponentParts(string $line): array
    {
        $data = [
            'id' => '',
            'weight' => null,
            'children' => null,
        ];

        $lineParts = explode(' -> ', $line);

        preg_match('/(?P<id>\w+)\s\((?P<weight>\d+)\)/', $lineParts[0], $matches);

        $data['id'] = isset($matches['id']) ? $matches['id'] : '';
        $data['weight'] = isset($matches['weight']) ? (int)$matches['weight'] : '';

        if (isset($lineParts[1])) {
            $children = str_replace(' -> ', '', $lineParts[1]);

            $data['children'] = explode(', ', $children);
        }

        return $data;
    }

    public function createDatabaseTables(): void
    {
        Capsule::schema()->drop('programs');

        Capsule::schema()->create('programs', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('weight');
            $table->string('parent_id')->nullable();
        });
    }

    public function populateDatabase(array $data)
    {
        $dataCount = count($data);
        $counter = 0;

        foreach ($data as $datum) {
            $counter++;

            $program = new Program();
            $program->id = $datum['id'];
            $program->weight = $datum['weight'];

            $program->save();
            echo "Inserted: {$counter}/{$dataCount}\r";
        }
        echo "\n";
    }

    public function establishRelationships(array $data)
    {
        foreach ($data as $datum) {

            /** @var Program $parentProgram */
            $parentProgram = Program::find($datum['id']);

            if (isset($datum['children'])) {

                foreach ($datum['children'] as $childId) {

                    /** @var Program $childProgram */
                    $childProgram = Program::find($childId);

                    echo "{$childProgram->id} -> {$parentProgram->id}\n";

                    $childProgram->parent()->associate($parentProgram);

                    $childProgram->save();

                }

            }

        }
    }

    public function getRootProgram(): Program
    {
        /** @var Program $childProgram */
        $program = Program::where('parent_id', null)->first();

        return $program;
    }
}
