<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;

class WordController extends Controller
{
    //W作成画面
    public function CreateFolderForm()
    {
        return view('user.CreateFolder');
    }
}