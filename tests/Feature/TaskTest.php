<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp() :void
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限日が日付ではない場合はバリデーションエラー
     * @test
     */
    public function test()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, // 不正なデータ（数値）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), // 不正なデータ（昨日の日付）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }

/**
  * 状態が定義された値ではない場合はバリデーションエラー
  * @test
  */
public function status_should_be_within_defined_numbers()
{
    $this->seed('TasksTableSeeder');

    $response = $this->post('/folders/3/tasks/3/edit', [
        'title' => 'Sample task',
        'due_date' => Carbon::today()->format('Y/m/d'),
        'status' => 999,
    ]);

    $response->assertSessionHasErrors([
        'status' => '状態 には 未着手、着手中、完了 のいずれかを指定してください。',
    ]);
}
}