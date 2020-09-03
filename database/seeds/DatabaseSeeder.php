<?php

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
        // $this->call(UserSeeder::class);

        $faker = Faker\Factory::create();

        for($i=0;$i<100;$i++){
            App\User::create([
                "username"=>$faker->userName,
                "email"=>$faker->email,
                "password"=>Hash::make('password'),
                "profile_picture"=>"http://gravatar.com/avatar/".md5(strtolower(trim($faker->email)))."?d=monsterid",
                "bio"=>Str::random(100)
                ]);
        }

        for($i=0;$i<100;$i++){
            App\Post::create([
                "title"=>$faker->title,
                "body"=>Str::random(100),
                "category_id"=>rand(1,20),
                "user_id"=>rand(1,100),

                ]);
        }

        for($i=0;$i<20;$i++){
            App\Category::create([
                "name"=>$faker->name,
                "user_id"=>rand(1,100),
                
                ]);

        }

        for($i=0;$i<100;$i++){
            App\Comment::create([
                "comment"=>Str::random(50),
                "user_id"=>rand(1,100),
                "post_id"=>rand(1,100)
                
                
                ]);
        }

        for($i=0;$i<100;$i++){
            App\Like::create([
                "like"=>rand(0,1),
                "user_id"=>rand(1,100),
                "post_id"=>rand(1,100),
                ]);
        }

        for($i=0;$i<100;$i++){
            App\Friend::create([
                "user_id_1"=>rand(1,100),
                "user_id_2"=>rand(1,100),
               
                ]);
        }
    }
}
