<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Services\CsvIterator;
use Database\Seeders\Traits\DisableForeignKeys;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;

class ProductSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $file = 'import/product.csv';
        if (Storage::disk('seeders')->exists($file)) {
            $productFile = Storage::disk('seeders')->path($file);
            $csv = new CsvIterator($productFile);

            $fields = [];
            foreach ($csv as $key => $row) {
                if (empty($row)) {
                    continue;
                }
                if ($key === 1) {
                    $fields = $row;
                } else {
                    $insertData = array_combine(array_values($fields), array_values($row));
                    $categories = [];
                    foreach ($insertData as $key => &$insertDatum) {
                        if (is_string($insertDatum)) {
                            $insertDatum = trim($insertDatum);
                        }
                        if ($insertDatum === '') {
                            $insertDatum = null;
                        }
                        if ($key == 'categories' || $key == 'related_products') {
                            $insertDatum = explode(',', $insertDatum);
                            if ($key == 'categories') {
                                $categories = $insertDatum;
                                unset($insertData[$key]);
                            }
                        }
                    }

                    $product = Product::firstOrCreate(
                        ['id' => $insertData['id']],
                        $insertData
                    );
                    $product->categories()->attach($categories);
                }
            }
        }
        $this->enableForeignKeys();
    }
}
