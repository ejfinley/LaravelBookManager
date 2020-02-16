<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    /**
     * Display a listing of books
     * 
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $books = Book::sortable()->paginate(5);
        return view('indexBook', compact('books'));
    }

    /**
     * Show the form for creating a new Book.
     * 
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        return view('createBook');
    }

    /**
     * Store a newly created book in storage.
     * This includes basic validation
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
        ]);
        $book = Book::create($validatedData);
        return redirect('/api/books')->with('success', 'Book was successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('editBook', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'author' => 'required|max:255',
            
        ]);
        Book::whereId($id)->update($validatedData);

        return redirect('/api/books')->with('success', 'Author was successfully updated');
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect('/api/books')->with('success', 'Book was successfully deleted');
    }

}
