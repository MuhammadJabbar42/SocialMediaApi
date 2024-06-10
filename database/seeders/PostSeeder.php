<?php

namespace Database\Seeders;


use App\Models\Post;
use App\Traits\ForeignKey;
use App\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    use TruncateTable,ForeignKey;

    public function run(): void
    {
        $this->disableForeignKey();
        $this->truncate('posts');
        $this->enableForeignKey();
        Post::factory(10)->create();
        
    }
}
