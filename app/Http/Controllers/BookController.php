<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Roomtype;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Roomtype::all();
        $books_num = Book::count();
        $books = Book::all();
        
        return view('index' , compact('types' , 'books_num' , 'books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('hi');
        $validatedData = $request->validate([
            'type' =>'required',
            'Name' =>'required',
            'Email' =>'required|email',
            'Phone' =>['required', 'numeric', 'regex:/(9)[0-9]{8}/'],
            'Arrival' =>'required|before_or_equal:Departure',
            'Departure' =>'required|after_or_equal:Arrival',
            'PersonNumber' =>'required|max:4|min:1',
        ]);
        $book = new Book();
        $book->roomtype_id = $request->type ;
        $book->name = $request->Name ;
        $book->email = $request->Email ;
        $book->number = $request->Phone ;
        $book->arrival_date = $request->Arrival ;
        $book->departure_date   = $request->Departure ;
        $book->count_person = $request->PersonNumber ;
        $book->save();
        return redirect('/book');

    }




    public function indexajax()
    {
        $types = Roomtype::all();
        $books_num = Book::count();
        $books = Book::all();
        
        return view('ajax' , compact('types' , 'books_num' , 'books'));
    }


    public function test(Request $request)
    {   
        
        $validatedData = $request->validate([
            'roomtype_id' =>'required',
            'name' =>'required',
            'email' =>'required|email',
            'number' =>['required', 'numeric', 'regex:/(9)[0-9]{8}/'],
            'arrival_date' =>'required|before_or_equal:departure_date',
            'departure_date' =>'required|after_or_equal:arrival_date',
            'count_person' =>'required|max:4|min:1',
        ]);
        
        $book = new Book();
        $book->roomtype_id = $request->roomtype_id ;
        $book->name = $request->name ;
        $book->email = $request->email ;
        $book->number = $request->number ;
        $book->arrival_date = $request->arrival_date ;
        $book->departure_date   = $request->departure_date ;
        $book->count_person = $request->count_person ;
        $book->save();
        return redirect('/book');

    }








    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        //
    }
}
