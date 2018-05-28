@extends('layouts.app')
@section('page-title', 'Blogs')
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <h2 align="center">Welcome to the Daily Blog</h2>

        <form method="post" action="\add">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row form-group">
                    <input type="text" class="form-control" id="blog_title" name="blog_title"
                              placeholder="Title goes here" required>
            </div>
            <div class="row form-group">
                    <textarea class="form-control" id="blog" rows="5" name="blog"
                              placeholder="AS YOU CAN MENTION YOUR BLOG HERE" required></textarea>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3"><label>Assign Category</label>
                            <select id="categories" data-size="5" data-selected-text-format="count > 4" multiple
                                    class="selectpicker form-control show-tick" name="category[]" title="category" required>
                                @foreach($categories as $category)
                                    <option title="{{$category->category_name}}" data-tokens="{{$category->id}}"
                                            value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Submit</button>
                    <a href="\show" type="button" class="btn btn-success" name="action" value="show">Show</a>
                </div>
            </div>
        </form>
    </div>
@endsection
