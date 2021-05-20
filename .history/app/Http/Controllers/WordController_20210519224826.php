<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;

class WordController extends Controller
{
    public function index(int $id)
    {
        $folder = Folder::all();
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
        // 選ばれたフォルダに紐づくタスクを取得する
        $task = Word::where('folders_id','=', $current_folder->id)->get();

        return view('tasks/index', [
            'folders' => $folder,
            'current_folder_id' => $current_folder->id,
            'tasks' => $task,
        ]);

    }
}
