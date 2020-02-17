<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromQuery;

class BooksExport implements FromQuery
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Book::select('title','author');
    }
}