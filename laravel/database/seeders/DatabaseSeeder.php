<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::truncate();
        Status::truncate();

        $roles = [
            'Admin',
            'Author',
            'Editor',
            'Maintainer',
            'Subscriber',
        ];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        $statuses = [
            'Pending',
            'Active',
            'Inactive',
        ];
        foreach ($statuses as $status) {
            Status::create([
                'name' => $status,
            ]);
        }

        User::truncate();
        User::create([
            'name' => 'user',
            'email' => 'email@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://instagram.fhan2-2.fna.fbcdn.net/v/t51.2885-15/e35/p1080x1080/80433275_126206448503350_3360481053559517405_n.jpg?_nc_ht=instagram.fhan2-2.fna.fbcdn.net&_nc_cat=110&_nc_ohc=Pt4wrXpgwM8AX_GMSbJ&edm=AP_V10EBAAAA&ccb=7-4&oh=faf54a325763b5675e844c97257768ea&oe=61172A35&_nc_sid=4f375e',
            'username' => 'username',
            'status_id' => 1,
            'role_id' => 1,
            'company' => 'company',
            'birth_date' => now(),
            'phone' => '0123456789',
            'website' => 'website',
            'language' => 'language',
            'gender' => true,
            'contact_options' => ['Email', 'Message', 'Phone',],
            'address_line_1' => 'address_line_1',
            'address_line_2' => 'address_line_2',
            'postal_code' => '1239182',
            'city' => 'city',
            'state' => 'state',
            'country' => 'country',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
