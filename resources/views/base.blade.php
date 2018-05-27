<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('plugins/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2 align="center">Welcome to the Daily Blog</h2>

        <form method="post" action="\add">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row form-group">
                <textarea class="form-control" id="blog" rows="5" name="blog"
                          placeholder="AS YOU CAN MENTION YOUR BLOG HERE" required></textarea>
            </div>
            <div class="row">
             <div class="form-group">
<div class="row">
      <div class="col-sm-3"><label>Assign Category</label>
                        <select id="categories" data-size="5" data-selected-text-format="count > 4" multiple class="selectpicker form-control show-tick" name="category[]" title="category" required>
                            @foreach($categories as $category)
                                <option  title="{{$category->category_name}}" data-tokens="{{$category->id}}" value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select></div>
</div></div>
            </div>
            <div class="row">
                       <div clas="form-group col-sm-3">
                        <button type="submit" class="btn btn-default" name="action" value="add">Submit</button>
                        <a href="\show" type="button" class="btn btn-default" name="action" value="show">Show</a>
            </div>
            </div>

        </form>
</div>
</body>
</html>
