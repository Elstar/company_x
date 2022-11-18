<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Services\CsvIterator;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;

class CategorySeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $categoryFile = Storage::disk('seeders')->path('import/category.csv');
        $csv = new CsvIterator($categoryFile);

        $fields = [];
        foreach ($csv as $key => $row) {
            if (empty($row)) {
                continue;
            }
            if ($key === 1) {
                $fields = $row;
            } else {
                $insertData = array_combine(array_values($fields), array_values($row));
                Category::firstOrCreate(
                    ['id' => $insertData['id']],
                    $insertData
                );
            }
        }
        $this->enableForeignKeys();
    }
}
