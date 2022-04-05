<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\News;


class NewsController extends Controller
{
    public function index(){
        //Ellquent
        //all rất cả bản ghi
        $news = News::all();
        //get : lấy ra toàn bộ các bản ghi, kết hợp  được với câu điều kiện
        //get : sẽ nằm cuối
        $newsGet = News::select('*')
        // ->where('id', '>', 3 )
        // ->get();
        ->with('category')
        // ->orderBy('id','desc')
        ->paginate(10);
        // dd($newsGet);
        return view('new.index', ['news' =>  $newsGet]);
        // dd('danh sách category', $categories, $categoriesGet);
        
    }
    public function create()
    {
        return view('news.create');
    }
    public function store(Request $request)
   
    {
        $request->validate([
            // nam nao se validate dieu kien gi
            'name'=>'required',
            
        ]);
        // neu co loi trong dieu kien truyen vao thi tu dong ket thuc
        // ham quay tro lai form kem bien $errors

        $newsRequest = $request->all();
        $news = new News();
        $news->name = $newsRequest['name'];
        $news->description = $newsRequest['description'];
        $news->status = $newsRequest['status'];
        $news->slug = Str::slug($newsRequest['name']) . '-' . uniqid();
        // use Illuminate\Support\Str;

        $news->save();

        return redirect()->route('categories.index');
    }
    public function edit(News $id){
        return view('news.create', ['news' => $id]);
    }
    public function delete(News $cate) {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($cate->delete()) {
            return redirect()->route('news.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $newsDelete = News::destroy($cate);
        if ($newsDelete !== 0) {
            return redirect()->route('news.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
    public function update(Request $request, News $id)
    {
        $cateUpdate=$id;
        $cateUpdate->name=$request->name;
        $cateUpdate->description =$request->description;
        $cateUpdate->slug = Str::Slug($request->name) . '-'. uniqid();
        $cateUpdate->status =$request->status;
        $cateUpdate->Update();
        // $category = Category::find($id);
        // $category->name = $request->name;
        // $category->description = $request->description;
        // $category->status = $request->status;
        // $category->slug = Str::slug($request->name);
        // $category->save();

        return redirect()->route('news.index');
    }

    
}
