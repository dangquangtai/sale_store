<?php

namespace Database\Factories;

use App\Admin;
use App\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_name' => $this->faker->name,
            'admin_email' => $this->faker->unique()->safeEmail,
            'admin_phone' => '020154225',
            'admin_password' => 'e10adc3949ba59abbe56e057f20f883eMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
           
        ];
       
    }
  
};
//   $factory->afterCreating(Admin::class,function($admin,$faker){
//             $roles =Roles::where('name','user')->get();
//              $admin->roles()->sync($roles->pluck('id_roles')->toArray());
//            });