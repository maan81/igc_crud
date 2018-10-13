<?php

namespace App\Http\Controllers;

use App\News;
use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        return view('news.list',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('news.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destinationPath = base_path('/public/uploads/');

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required'
        ]);

        $news = new News();

        $news->title = $request->input('title');
        $news->author = $request->input('author');
        $news->content = $request->input('newsDescription');;
        $news->Published_date = $request->input('publishedDate');;
        $news->category_id = $request->input('categoryId');

        $news->created_at = now();

        // Highlights      varchar(200)    utf8mb4_unicode_ci      No  None            Change Change   Drop Drop
        // category_name   varchar(50)     utf8mb4_unicode_ci      No  None            Change Change   Drop Drop

        $news->save();

        if (Input::hasFile('image'))
        {
            $fileName = Input::file('image')->getClientOriginalName();
            Input::file('image')->move($destinationPath, $news->id);
        }

        return redirect()->route('/news', 'NewsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
