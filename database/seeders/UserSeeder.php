<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users =    
        [
            [
                'name' => 'John Doe',
                'email' => 'tajtariq227@gmail.com'
               
            ],
            [
                'name' => 'Jane asdaDoe',
                'email' => 'admin@gmail.com'
            ],
            
        ];

        foreach ($users as $user) {
            $model = new User();
            $model->name = $user['name'];  
            $model->email = $user['email'];
            $model->password = Hash::make('admin12345');
            $model->save();
        }
    }
}
