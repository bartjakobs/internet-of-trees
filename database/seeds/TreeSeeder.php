<?php

use Illuminate\Database\Seeder;

class TreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 40)->create()->each(function ($u) {
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
            $u->trees()->save(factory(App\Tree::class)->make());
        });
    }
}
