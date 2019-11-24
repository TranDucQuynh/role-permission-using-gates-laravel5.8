<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name' => 'Author',
            'slug' => 'author',
            'permissions' => json_encode([
                'create-post' => true,
            ]),
        ]);
        $editor = Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permissions' => json_encode([
                'update-post' => true,
                'publish-post' => true,
            ]),
        ]);
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => json_encode([
                'create-post' => true,
                'update-post' => true,
                'publish-post' => true,
                'delete-post' => true,
            ]),
        ]);
    }
}
