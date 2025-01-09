<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com']);
        $user2 = User::factory()->create([
                'name' => 'club',
                'email' => 'club@example.com']);
        $user3 = User::factory()->create([
                'name' => 'athlete',
                'email' => 'athlete@example.com']);
                
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Club']);
        $role3 = Role::create(['name' => 'Athlete']);

        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);
        
    }
}
