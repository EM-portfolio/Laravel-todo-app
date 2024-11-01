<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // シーダーデータの挿入
    $contacts = [
        [
            'name' => '田中太郎',
            'email' => 'tanaka@example.com',
            'gender' => '男性',
            'category' => '製品について',
            'address' => '北海道',
            'message' => '製品についての問い合わせです。',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => '山田花子',
            'email' => 'yamada@example.com',
            'gender' => '女性',
            'category' => 'サービスについて',
            'address' => '東北',
            'message' => 'サービスについての問い合わせです。',
            'image' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],

    ];

    // データの挿入
    foreach ($contacts as $contact) {
        Contact::create($contact);
        //DB::table('contacts') -> insert($contact);
    }
    

}
}