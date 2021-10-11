<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Str;

use App\Models\Channel;
use App\Models\Discussion;
use App\Models\Reply;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //---------------------User----------------------//

        \App\Models\User::create([
            'name' => 'Shahzad Adil',
            'password' => bcrypt('admin'),
            'email' => 'shahzad@forum.com',
            'admin' => 1,
            'avatar' => asset('avatars/avatar.png'),
        ]);

        \App\Models\User::create([
            'name' => 'Emily',
            'password' => bcrypt('password'),
            'email' => 'emily@forum.com',
            'avatar' => asset('avatars/avatar.png'),
        ]);

        //---------------------Channel----------------------//

        $channel1 = ['title' => 'Laravel 1.0', 'slug' => Str::slug('Laravel 1.0')];

        $channel2 = ['title' => 'Html and css', 'slug' => Str::slug('Html and css') ];

        $channel3 = ['title' => 'Spring boot', 'slug' => Str::slug('Spring boot')];

        $channel4 = ['title' => 'Flutter 2.3', 'slug' => Str::slug('Flutter 2.3')];

        $channel5 = ['title' => 'Wordpress 4.4', 'slug' => Str::slug('Wordpress 4.4')];

        Channel::create($channel1);

        Channel::create($channel2);

        Channel::create($channel3);

        Channel::create($channel4);

        Channel::create($channel5);

        //---------------------Discussion----------------------//

        $t1 = 'Eloquent Model Conventions';

        $t2 = 'Laravel Encryption';

        $t3 = 'Wordpress Multi-user and multi-blogging';

        $d1 = [
            'title' => $t1,
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'channel_id' => 1,
            'user_id' => 2,
            'slug' => Str::slug($t1),
        ];

        $d2 = [
            'title' => $t2,
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'channel_id' => 1,
            'user_id' => 1,
            'slug' => Str::slug($t2),
        ];

        $d3 = [
            'title' => $t3,
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'channel_id' => 5,
            'user_id' => 1,
            'slug' => Str::slug($t3),
        ];

        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);


        //---------------------Reply----------------------//

        $r1 =[
            'user_id' => 1,
            'discussion_id' => 1,
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. ",
        ];

        $r2 =[
            'user_id' => 2,
            'discussion_id' => 2,
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. ",
        ];

        $r3 =[
            'user_id' => 2,
            'discussion_id' => 3,
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. ",
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);


    }
}
