<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromQuery;

class TitlesExport implements FromQuery
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Book::select('title');
    }
}
