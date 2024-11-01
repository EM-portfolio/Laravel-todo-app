<?php

namespace App\Policies;

use App\Folder;
use App\User;

// folderモデルの認可ルールを設定(<モデル名>policy)
// Laravelの認可機能が必要となるタイミングで読み込まれる
//authで保護されたページにアクセスした場合、FolderPolicyが読み込まれる
class FolderPolicy
{

    /**
     * phpdoc -型説明-
     * 
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */

    public function view(User $user, Folder $folder)
    {
        //UserIDがFolderのuser_IDと一致するかどうか
        // 特定のユーザーが特定のフォルダを閲覧できるかどうか。
        return $user -> id == $folder -> user_id;
    }
}
