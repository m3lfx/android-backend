<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Storage;

class ItemController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['index']]);
    // }
    // public function __construct() {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json(["data" => $items]);
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
    public function store(Request $request) {
        $item = new Item;
        $item->description = $request->description;
        $item->sell_price = $request->sell_price;
        $item->cost_price = $request->cost_price;
        $files = $request->file('uploads');
        // $item->img_path = 'images/'.$request->img_path.'.jpg';
        $item->img_path = 'images/'.$request->img_path;
        $item->save();
        // Storage::put('public/images/'.base64_decode(file_get_contents($files)));
        Storage::put('public/images/'.$request->img_path,base64_decode($request->uploads));
        return response()->json(["message" => "item created successfully.","item" => $item,"status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);

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
        $item = Item::find($id);
        $item->description = $request->description;
        $item->sell_price = $request->sell_price;
        $item->cost_price = $request->cost_price;
        $files = $request->file('uploads');
        // $item->img_path = 'images/'.$request->img_path.'.jpg';
        $item->img_path = 'images/'.$request->img_path;
        $item->save();
       
        Storage::put('public/images/'.$request->img_path,base64_decode($request->uploads));
       
        return response()->json(["message" => "item updated successfully.","item" => $item,"status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return response()->json(['status' => 'item deleted', 'code' => 200]);
    }
}
