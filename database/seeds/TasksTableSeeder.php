<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //tasksテーブルにテストデータを挿入する
        foreach( range(1,3) as $num){
            DB::table('tasks') -> insert([
                'folder_id' => 1,
                'title' => "サンプルタスク{$num}",
                'status' => $num,
                'due_date' => Carbon::now()->addDay($num), // addDayは日付を加算する
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }

    }
}
