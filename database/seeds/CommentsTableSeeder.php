<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Post;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 'catturo' solo i post pubblicati
        $posts = Post::where('published', 1)->get();
        // ciclo tali post
        foreach ($posts as $post) {
            // ciclo 'n' volte per creare il numero di commenti
            for ($i = 0; $i < rand(0, 3); $i++) {
                $newComment = new Comment();
                $newComment->post_id = $post->id;
                $newComment->name = $faker->name();
                $newComment->content = $faker->text();
                $newComment->save();
            }
        }
    }
}
