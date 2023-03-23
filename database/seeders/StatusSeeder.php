<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(
            [
                'type'=>'In Stock'
            ]);
        Status::create(
            [
                'type'=>'Out of Stock'
            ]);
        Status::create(
            [
                'type'=>'Low in Stock'
            ]);
    }
}
