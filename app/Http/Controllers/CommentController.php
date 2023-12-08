<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
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
        $customer = Customer::find($request->id);
        return view('comment.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = new Comment();
        $store->date = $request->date;
        $store->time = $request->time;
        $store->title = $request->title;
        $store->lead_id = $request->id;
        $store->user_id = Auth::user()->id;
        $store->save();
        return back()->with('success', 'Comment Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::where('lead_id', $id)->orderBy('id', 'desc')->get();
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
