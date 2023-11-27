<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Repositories\DownloadBookRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository = null;

    public function __construct(DownloadBookRepository $repository)
    {
        $this->repository = $repository;
    }
    public function library(){
       $records = $this->repository->all();
       return view('frontend.download_book.DownloadBook', compact('records'));
    }

    public function showDownloadBook($id){
        $record = $this->repository->show($id);
        $related = $this->repository->related($record->class);
        return view('frontend.download_book.ShowDownloadBook', compact('record', 'related'));
    }
}
