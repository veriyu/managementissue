<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Image;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'list isu';

        $query = Issue::query();
        if(request()->name){
            $query->where('name','LIKE','%'.request()->name.'%');
        }
        $data = $query->paginate(10);

        return view('issue.index',compact('data','pageTitle'));
    }

    public function trash()
    {
        $pageTitle = 'list trash';
        $data = Issue::onlyTrashed()->paginate(20);

        return view('issue.index-trash',compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'isu baru';

        return view('issue.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'date' => 'required'
        ];

        $message = [
            'name.required' => 'tolong isi isunya',
            'date.required' => 'tolong isi tanggal'
        ];

        $request->validate($rules,$message);

        $data = $request->except('_token');

        if(request()->img){

             // step 1 : tujuan simpan file
            $path = public_path('/img/');

            // step 2 : olah data gambar dengan package
            $originalImage= $request->img;
            $Image = Image::make($originalImage);

            // step 3
            $Image->resize(540,360);

            // step 4
            $fileName = time().$originalImage->getClientOriginalName();
            $Image->save($path.$fileName);

            // step 5
            $data['img'] = $fileName;
        }

        Issue::create($data);

        return redirect()->route('issue.index');
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
    public function edit(Issue $issue)
    {
        $pageTitle = 'ubah isu';

        return view('issue.edit',compact('issue','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        $rules = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'tolong isi isunya'
        ];

        $request->validate($rules,$message);

        $data = $request->except('_token');

        $issue->update($data);

        return redirect()->route('issue.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issue.index');
    }

    public function remove($id)
    {
        Issue::withTrashed()->where('id',$id)->first()->forceDelete();

        return redirect()->route('issue.trash');
    }

    public function restore($id)
    {

        Issue::withTrashed()->where('id',$id)->first()->restore();

        return redirect()->route('issue.trash');
    }
}
