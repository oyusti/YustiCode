<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = [
            'php','laravel','python','javascript','vuejs','reactjs','nodejs','tailwindcss','bootstrap','css','html','mysql','postgresql','mongodb','sql','git','github','gitlab','bitbucket','docker','aws','azure','gcp','linux','windows','macos','android','ios','flutter','dart','java','c#','c++','c','ruby','go','kotlin','swift','rust','typescript','angular','spring','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs','rubyonrails','laravel','codeigniter','cakephp','django','flask','symfony','express','nextjs','nuxtjs','svelte','emberjs'
        ];

        foreach ($tag as $item) {
            \App\Models\Tag::create([
                'name' => $item,
            ]);
        }
    }
}
