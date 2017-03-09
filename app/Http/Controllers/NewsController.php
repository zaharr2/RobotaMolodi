<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = News::all();

        return view('newDesign.News.newsIndex', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('newDesign.News.newsForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|unique:news,id',
                'description' => 'required',
                'image' => 'sometimes|image|required|max:10240',
            ]);
//            $validator = Validator::make($request->all(), [
//                'title' => 'required|unique:news,id',
//                'description' => 'required',
//                'image' => 'image|required|max:10240',
//            ]);
//
//            if ($validator->fails())
//            {
//                return redirect()->back()->withErrors($validator->errors());
//            }
        }
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = 'image/uploads/news';
        $file->move($destinationPath, $file->getClientOriginalName());

        $news = new News();
//        $news->validation($request);
//        $news->errors();
        $news->createModel($request, $fileName);
        $news = News::all();
        return view('newDesign.News.newsIndex', ['news' => $news]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
