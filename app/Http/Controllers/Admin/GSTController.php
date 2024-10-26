<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GST;
use Illuminate\Http\Request;

class GSTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_gst = Gst::all();
        return view('admin.gst.index',compact('all_gst'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gst.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->gst != ''){
            $gst = GST::create([
                'gst' => $request->gst,
            ]);    
        }
        return redirect()->route('admin.gst.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gst = GST::where('id',$id)->first();
        
        return view('admin.gst.show',compact('gst'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $gst = GST::where('id',$id)->first();

        return view('admin.gst.edit',compact('gst'));
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
        if($request->gst != ''){
            $gst = GST::where('id',$id)->first();
            $gst->update([
                'gst' => $request->gst,
            ]);
        }
        return redirect()->route('admin.gst.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gst = GST::where('id',$id)->delete();

        return redirect()->route('admin.gst.index');
    }
}
