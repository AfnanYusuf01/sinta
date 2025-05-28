<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Create some default dosen accounts
        $dosen_data = [
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi.santoso@dosen.com',
                'nip' => '198501012010121001',
            ],
            [
                'name' => 'Dr. Siti Rahayu',
                'email' => 'siti.rahayu@dosen.com',
                'nip' => '198601012010121002',
            ],
            [
                'name' => 'Dr. Ahmad Wijaya',
                'email' => 'ahmad.wijaya@dosen.com',
                'nip' => '198701012010121003',
            ],
        ];

        foreach ($dosen_data as $data) {
            // Create user account
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);

            // Create dosen profile
            Dosen::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'nip' => $data['nip'],
            ]);
        }

        $this->command->info('3 dosen created successfully.');
    }
}
