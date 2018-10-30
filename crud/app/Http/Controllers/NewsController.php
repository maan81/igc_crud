<?php

namespace App\Http\Controllers;

use App\News;
use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{

    // path( folder) to save images and thumbnails
    protected $destinationPath;
    protected $urlPath;

    public function __construct()
    {
        $this->destinationPath = base_path('public/uploads/');
        $this->urlPath = '/uploads/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('deleted_at',null)->get();

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

            $filename = $news->id.'.'.Input::file('image')->getClientOriginalExtension();

            Input::file('image')->move($this->destinationPath, $filename);

            \File::copy($this->destinationPath.$filename, $this->destinationPath.'thumbs/'.$filename);

            Image::make($this->destinationPath.'thumbs/'.$filename)->resize(100,100)->save($this->destinationPath.'thumbs/'.$filename);
        }

        return redirect('/news/'.$news->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Categories::all();

        $news = News::findOrFail($id);

        $selectedCategories = [];
        foreach ($news->categories as $newsCategories) {
            $selectedCategories[] = $categories[$newsCategories->id];
        }

        return view('news.show', [
            'news' => News::findOrFail($id),
            'selectedCategories' => $selectedCategories,
            'categories' => $categories,
            'urlPath' => $this->urlPath,
            'filename' => $id.'.jpg', // <<------- !!!!!!!!! image type fixed to jpg !!!!!!!!!!!
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Categories::all();

        $selectedCategories = [];
        foreach ($news->categories as $newsCategories) {
            $selectedCategories[] = $categories[$newsCategories->id];
        }

        return view('news.edit', [
            'news' => $news,
            'selectedCategories' => $selectedCategories,
            'categories' => $categories,
            'urlPath' => $this->urlPath,
            'filename' => $news->id.'.jpg', // <<------- !!!!!!!!! image type fixed to jpg !!!!!!!!!!!
        ]);
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
        $newsId = $request->input('newsId');;

        $news = News::find($newsId);

        $news->title    = $request->input('title');
        $news->author   = $request->input('author');
        $news->content  = $request->input('newsDescription');;
        $news->Published_date = $request->input('publishedDate');;

        $news->updated_at = now();

        // Highlights      varchar(200)    utf8mb4_unicode_ci      No  None            Change Change   Drop Drop
        // category_name   varchar(50)     utf8mb4_unicode_ci      No  None            Change Change   Drop Drop

        $news->save();



        $selectedCategories = [];
        foreach ($request->input('categoryId') as $newsCategories) {
            $selectedCategories[] = $newsCategories;
        }

        $news->categories()->sync($selectedCategories);


        if (Input::hasFile('image'))
        {

            $filename = $news->id.'.'.Input::file('image')->getClientOriginalExtension();

            Input::file('image')->move($this->destinationPath, $filename);

            \File::copy($this->destinationPath.$filename, $this->destinationPath.'thumbs/'.$filename);

            Image::make($this->destinationPath.'thumbs/'.$filename)->resize(100,100)->save($this->destinationPath.'thumbs/'.$filename);
        }

        return redirect('/news/'.$request->input('newsId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->deleted_at = now();
        $news->save();

        return redirect('news');
    }
}
