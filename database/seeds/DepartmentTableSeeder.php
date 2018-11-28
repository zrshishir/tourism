<?php

use App\Models\Department\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Department::insert(array(
                      array('name' => 'managing','created_at' => '2018-10-12 13:24:24','updated_at' => '2018-10-12 13:24:24'),
                      array('name' => 'hr','created_at' => '2018-10-12 13:24:46','updated_at' => '2018-10-12 13:24:46')
                    ));
    }
}
