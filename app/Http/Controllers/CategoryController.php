<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class CategoryController extends Controller
{
    public function index(){
        //Ellquent
        //all rất cả bản ghi
        $categories = Category::all();
        //get : lấy ra toàn bộ các bản ghi, kết hợp  được với câu điều kiện
        //get : sẽ nằm cuối
        $categoriesGet = Category::select('*')
        
        // ->where('id', '>', 3 )
        // ->get();
        ->orderBy('id','desc')
        ->paginate(10);
        return view('category.index', ['categories' =>  $categoriesGet]);
        // dd('danh sách category', $categories, $categoriesGet);
        
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
   
    {
        $request->validate([
            // nam nao se validate dieu kien gi
            'name'=>'required',
            
        ]);
        // neu co loi trong dieu kien truyen vao thi tu dong ket thuc
        // ham quay tro lai form kem bien $errors

        $categoryRequest = $request->all();
        $category = new Category();
        $category->name = $categoryRequest['name'];
        $category->description = $categoryRequest['description'];
        $category->status = $categoryRequest['status'];
        $category->slug = Str::slug($categoryRequest['name']) . '-' . uniqid();
        // use Illuminate\Support\Str;

        $category->save();

        return redirect()->route('categories.index');
    }
    public function edit(Category $id){
        return view('category.create', ['category' => $id]);
    }
    public function delete(Category $cate) {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($cate->delete()) {
            return redirect()->route('categories.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $categoryDelete = Category::destroy($cate);
        if ($categoryDelete !== 0) {
            return redirect()->route('categories.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
    public function update(Request $request, Category $id)
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

        return redirect()->route('categories.index');
    }
}