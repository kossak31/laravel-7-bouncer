<?php

use App\Comment;
use App\Post;
use App\User;

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(User::class)->create([
            'name' => 'admin user',
            'email' => 'admin@admin.net',
            'password' => bcrypt('password')
        ]);

        $creatorOfPosts = factory(User::class)->create([
            'name' => 'post user',
            'email' => 'creator@post.net',
            'password' => bcrypt('password')
        ]);

        /**
         * create and delete
         * table roles
         */
        Bouncer::allow('admin')->everything();

        /**
         * create abilitess create and delete
         * table abilites
         */

        $creatorOfPosts->allow('create', Post::class);
        $creatorOfPosts->allow('delete', Comment::class);

        /**
         * assign admin user to admin role
         * 
         */
        $admin->assign('admin');
    }
}
