{{-- Home sẽ kế thừ viiew master --}}
@extends('layout.master')
{{-- section sẽ thay đổi phần yeild trong master --}}
@section('title', 'New page')
@section('content-title', 'New page')
@section('content')
<div>
    <a href="{{route('news.add')}}">
        <button class="btn btn-primary">Create</button>
    </a>
</div>

<table class="table table-hover">
    
    <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Category</th>
        <th>Product</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Actions</th>
        
    </thead>
    <tbody>
     @foreach ($news as $new) 
        
        <tr>
            <td>{{$new->id}}</td>
            <td>{{$new->title}}</td>
            <td>{{$new->description ?: 'N/A'}}</td>
            <td>{{$new->category->name ?: 'N/A'}}</td>
            <td>
                @foreach ($new->product as $item)
                    {{'- '.$item->name}}
                    <br>
                @endforeach
            </td>
            <td>{{$new->created_at ?: 'N/A'}}</td>
            <td>{{$new->updated_at ?: 'N/A'}}</td>  
            <td>
                <a href="{{route('news.edit', $new->id)}}" class="btn btn-warning">
                    Edit
                </a>
                    <form
                    action="{{route('news.delete', $new->id)}}"
                    method="POST">
                    @method('DELETE')
                    {{-- <input type="text" name="_method" value="DELETE"> --}}
                    @csrf
                    {{-- <input type="text" name="csrf_token" value="asdadasd"> --}}
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
                </td>       
        </tr>             
     @endforeach          
    </tbody>
</table>
 {{ $news->links() }}

@endsection
