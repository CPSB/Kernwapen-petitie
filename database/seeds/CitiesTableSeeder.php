<?php

use App\Repositories\CityRepository;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Database\Seeder;

/**
 * Class CitiesTableSeeder
 */
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param CityRepository $cityRepository    Abstraction layer bewteen seeder and database Model
     * @param Statement      $stmt              CSV Statement class
     *
     * @throws \League\Csv\Exception
     *
     * @return void
     */
    public function run(CityRepository $cityRepository, Statement $stmt): Void
    {
        // 1) Start Truncate
        DB::table('cities')->truncate();

        // 2) Start INSERT
        $csv = Reader::createFromPath(database_path('seeds/sources/belgian-cities.csv'), 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset

        foreach ($stmt->process($csv) as $record) {
            $cityRepository->create($record);
        }
    }
}
