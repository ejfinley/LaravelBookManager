<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Exports\BooksExport;
use App\Exports\AuthorsExport;
use App\Exports\TitlesExport;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use DB;

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
     * Display a listing of based on a query
     * @param  string searchTerm the string to search
     * @return \Illuminate\Http\Response
     */
    public static function query(Request $request)
    { 
        $books = Book::query()
                ->where('title', 'LIKE', "%{$request->get('search')}%") 
                ->orWhere('author', 'LIKE', "%{$request->get('search')}%") 
                -> sortable()->paginate(5);
        return view('indexBook', compact('books'));
    }
    /**
     * Export database based on a format and filter variable
     * @param  string searchTerm the string to search
     * @return \Illuminate\Http\Response
     */
    public static function export(Request $request)
    {  
       //Excel is handled by a library
       if($request->get('format') == 'csv'){
            if($request->get('filter') == 'author'){
                return Excel::download(new AuthorsExport, 'authors.csv');
            } else if ($request->get('filter') == 'title'){
                return Excel::download(new TitlesExport, 'titles.csv');
            } else if ($request->get('filter') == 'both'){      
                return Excel::download(new BooksExport, 'books.csv');
            }    
        // We will format the xml
       } else if ($request->get('format') == 'xml'){
            $books = Book::All();
            $xml = new \XMLWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0');
            if($request->get('filter') == 'author'){
                $xml->startElement('authors');
                foreach ($books as $book) {
                    $xml->writeElement('author', $book->author);
                }
                $xml->endElement();
            } else if ($request->get('filter') == 'title'){
                $xml->startElement('titles');
                 foreach ($books as $book) {
                    $xml->writeElement('title', $book->title);
                }
                $xml->endElement();
            } else if ($request->get('filter') == 'both'){      
                $xml->startElement('books');
                 foreach ($books as $book) {
                    $xml->startElement('book');
                    $xml->writeElement('title', $book->title);
                    $xml->writeElement('author', $book->author);
                    $xml->endElement();
                }
                $xml->endElement();
            }
            $content = $xml->outputMemory();
            $response = Response::make($content, 200);
            $response->header('Content-Type', 'text/xml');
            $response->header('Cache-Control', 'public');
            $response->header('Content-Description', 'File Transfer');
            $response->header('Content-Disposition', 'attachment; filename=' . $request->get('filter')  . 'xml');
            $response->header('Content-Transfer-Encoding', 'binary');
            return $response;
       }
      
       

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
     * Show the page for export options
     * 
     * @return \Illuminate\Http\Response
     */
    public static function exportPage()
    {
        return view('exportBook');
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
