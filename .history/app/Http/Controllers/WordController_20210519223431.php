<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;

class WordController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

    }
}