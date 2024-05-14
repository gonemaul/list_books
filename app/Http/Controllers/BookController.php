<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest();

        if(Request('search')){
            $books->where('title', 'like' ,'%' . request('search') . '%')
                ->orWhere('author', 'like' ,'%' . request('search') . '%');
        }

        return view('home',[
            'books' => $books->get(),
            'title' => 'List Books'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create', ['title' => 'Add New Book']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => 'required',
            'cover' => 'image|file|max:1024',
            'description' => 'required',
        ]);

        if ($request->file('cover')){
            $validateData['cover'] = $request->file('cover')->store('cover_book');
        }
        else{
            $validateData['cover'] = 'cover_book/no_preview_available.png';
        }

        $validateData['title'] = Str::title($request->title);
        $validateData['author'] = Str::title($request->author);

        Book::create($validateData);
        return redirect('/books')->with('success' , 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('detail',[
            'title' => 'Detail Book',
            'data' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('edit',[
            'title' => 'Change Book',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => 'required',
            'cover' => 'image|file|max:1024',
            'description' => 'required',
        ]);

        if($request['checkbox']){
            if($book->cover != 'cover_book/no_preview_available.png'){
                Storage::delete($book->cover);
            }
            $validateData['cover'] = 'cover_book/no_preview_available.png';
        }
        else{
            if ($request->file('cover')){
                if($book->cover != 'cover_book/no_preview_available.png'){
                    Storage::delete($book->cover);
                }
                $validateData['cover'] = $request->file('cover')->store('cover_book');
            }
            elseif($book->cover == 'cover_book/no_preview_available.png'){
                return dd('Please Include the Cover');
            }
        }

        Book::where('id', $book->id)->update($validateData);
        return redirect('/books')->with('success' , 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($book->cover != 'cover_book/no_preview_available.png'){
            Storage::delete($book->cover);
        }

        Book::destroy($book->id);
        return redirect('/books')->with('success' , 'Data berhasil dihapus!');
    }
}
