<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ArticlesController extends Controller
{

    // Rate limiting defined in RouteServiceProvider.php
    // 60 requests per minute
    public function __construct(){
        $this->middleware(['throttle:article']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::orderBy('created_at','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'name'  =>  $request->name,
            'link'  =>  $request->link,
        ]);

        return $article;
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
        //
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
        $article = Article::find($id);
        if (!$article) {
            return [
                'success'   =>  false,
                'message'   =>  'No such article'
            ];
            die;
        }


        $article->read = $request->completed ? true : false;
        $article->read_at = $request->completed ? Carbon::now() : null;
        $article->save();

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return [
                'success'   =>  false,
                'message'   =>  'No such article'
            ];
            die;
        }

        $article->delete();

        return [
            'success'   =>  true,
            'message'   =>  'article deleted successfully'
        ];

    }
}
