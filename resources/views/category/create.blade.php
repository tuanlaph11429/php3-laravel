@extends('layout.master')

@section('title', 'Category page')



@section(
    'content-title',
    isset($category) ? 'Category Edit' : 'Category Create'
)

@section('content')
    <form 
    action="{{isset($category)
     ?route('categories.update', $category->id)
     :route('categories.store')}}"
     class="form" 
     method="POST"
>
     @if(isset($category))
        @method('PUT')
    @endif
        {{-- Bat buoc trong form se phai co token bang @csrf --}}
        @csrf
        {{-- sau khi validate co loi , redirect kem theo $errors 
            kiem tra neu co loi bang->any()
            lay ra danh sach loi ->all     --}}
        @if (errors->any())
        <ul class="text-danger">
            @foreach ($errors as $error)
            <li> {{$error->name}}</li>
            @endforeach
        </ul>
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input
                name="name"
                class="form-control"
                id="name"
                value="{{isset($category) ? $category->name : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input
                name="description"
                class="form-control"
                id="description"
                value="{{isset($category) ? $category->name : ''}}"
            />
        </div>
        <div class="form-group">
            <input type="radio" 
                name="status" 
                id="status" 
                value="0"
                {{isset($category) && $category->status == 0 ? 'checked' : ''}}>
            <label for="status">Deactive</label>
        </div>
        <div class="form-group">
            <input type="radio" 
                name="status" 
                id="status" 
                value="1"
                {{isset($category) && $category->status == 1 ? 'checked' : ''}}>
            <label for="status">Active</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sumit</button>
            <a href="{{route('categories.index')}}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>

@endsection
