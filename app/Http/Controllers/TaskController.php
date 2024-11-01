<?php
// 名前空間定義（同じクラスがあっても、衝突を防ぐ）
namespace App\Http\Controllers;


// クラスをこのファイルで使う事を宣言
use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;



// TaskControllerという新しいクラスを定義
// extends で Controllerクラスを継承(Controllerクラスが持つ機能を利用可能)
class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */

    // URLのパラメータと同じ名前の型指定をした引数をコントローラーメソッドに追加するだけで、
    // 自動的に該当のモデルインスタンスを取得
    public function index(Folder $folder){

        // Folderモデルからすべてのレコードを取得し、変数に代入
        // ::all()はEroquantのメソッド。モデル元であるFolder.phpで呼び出してる
        // $folders = Folder::all();

        // 存在はするが自分のものではないフォルダの ID を含む URL にアクセスされた場合
        if(Auth::user()->id !== $folder->user_id)
        {
            abort(403);
        }

        $folders = Auth::user() -> folders() -> get(); // 現在のユーザーに紐づくフォルダだけを取得

       // Taskモデル(クラス)を利用し、folder_id列から$current_folderがid列に一致するレコードをget()で取得する
       // $tasks = Task::where('folder_id', $current_folder->id)->get(); // whereメソッドはwhere句に相当
       $tasks = $folder -> tasks() -> get(); 

       // 以下は、viewのファイルの指定と値の受け渡し
        //$foldersというデータを'folders'という名前でビューに渡す 角かっこがあるため、これは配列になる
        
        //resources/views/tasks/indexファイルを表示する
        return view('tasks/index', [
           'folders' => $folders,
           'current_folder_id' => $folder->id,
           'tasks' => $tasks,

       ]);
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        //resources/views/tasks/createファイルを表示する
        return view('tasks/create', [
            'folder_id' => $folder -> id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Folder $folder, CreateTask $request)
    {   
       
        
        // taskクラスをインスタンス化(taskモデル)
        $task = new Task();
        
        // taskのタイトル(todoのタスク名)に #titleを代入
        $task -> title = $request -> title;

        // taskの日付(todoのタスク名)に #due_dateを代入
        $task -> due_date = $request -> due_date;
        
        //$idに対してのinsertを行う
        //"select * from "tasks" where "tasks"."folder_id" = ? and "tasks"."folder_id" is not null"
        $folder -> tasks() -> save($task);
        
        return redirect()-> route('tasks.index', [
            'id' => $folder -> id,
        ]);
    }
    
    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */

    public function showEditForm(Folder $folder, Task $task) 
    {

        $this -> checkRelation($folder, $task);
        //resources/views/tasks/editファイルを表示する
        return view('tasks/edit', ['task' => $task,]);
    }





    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    
    // EditTask... Requests/EditTask.php内に記載されているクラス名
    // $request... バリデーションされたデータが内包されている
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);
        
        $task->title = $request->title;
        $task -> status = $request -> status;
        $task -> due_date = $request -> due_date;
        //saveはデータの差分を見る
        //updateは差分を見ない
        $task -> save(); // saveメソッドで差分が発生した場合はUPDATE、差分がない場合はINSERT

        return redirect() -> route('tasks.index',[
            'id' => $task -> folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        //タスク編集フォームにアクセスした時、タスクIDと、ユーザーIDが一致しなかったら404を出す。
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }



}


