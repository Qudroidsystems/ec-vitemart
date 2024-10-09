<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit products']);

        $role->givePermissionTo($permission);

        $user = User::factory()->create([
            'name' => 'Daniel Ryan',
            'email' => 'danryan0246@gmail.com',
            'password' => Hash::make('silverstar')
        ]);

        $user2 = User::factory()->create([
            'name' => 'Daniel Customer',
            'email' => 'danryan02246@gmail.com',
            'password' => Hash::make('silverstar')
        ]);

        $user->assignRole('admin');

        $this->call(UploadSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TaggingSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);

        $this->call(BillingAddressSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ProductStoreSeeder::class);
        $this->call(ShelfSeeder::class);
        $this->call(BrandingSeeder::class);
    }
}
