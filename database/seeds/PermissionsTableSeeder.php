<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['modify', 1, 'Grants permission to edit database records.'],
            ['create', 2, 'Grants permission to create new database records.'],
            ['publish', 3, 'Grants permission to make pdf copies of database records.'],
            ['delete', 4, 'Grants permission to delete data from the database.'],
            ['admin', 5, 'Grants administrative rights. Gives full access and control of the system.'],
        ];

        $id = 1;
        foreach ($permissions as $permission) {
            // Create permission
            Permission::create([
                'id'=> $id,
                'action'=> $permission[0],
                'level'=> $permission[1],
                'description'=> $permission[2],
            ]);
            // Next id
            $id++;
        }
    }
}
