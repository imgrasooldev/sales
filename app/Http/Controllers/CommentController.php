<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customer = Payment::find($request->id);
        return view('comment.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email = Payment::find($request->id);
        $store = new Comment();
        $store->date = $request->date;
        $store->time = $request->time;
        $store->title = $request->title;
        $store->lead_id = $email->customeremail;
        $store->user_id = Auth::user()->id;
        $store->visibility = $request->visibility;
        $store->save();
        return back()->with('success', 'Comment Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $email = Payment::find($id);
        $comment = Comment::join('users as u', 'u.id', 'comments.user_id', 'comments.create_at as create_at')->where('lead_id', $email->customeremail)->orderBy('comments.id', 'desc')->get();
        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
