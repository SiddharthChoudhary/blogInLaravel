@extends('layouts.app')
@section('page-title', 'Blogs')
@section('content')

    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <h3>Filters</h3>
                <div class="form-group">
                    <label>Select Category</label>
                    <select id="categories" data-size="5" data-selected-text-format="count > 4" multiple
                            class="selectpicker form-control show-tick" name="category[]" title="category" required>
                        @foreach($categories as $category)
                            <option title="{{$category->category_name}}" data-tokens="{{$category->id}}"
                                    value="{{$category->id}}">{{$category->category_name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Date</label>
                    <input id="datepicker" class="form-control" name="date_selected" data-provide="datepicker">
                    {{--<button type="button" id="datepicker_applybutton" class="btn btn-primary" name="author_name_button">
                        Apply
                    </button>--}}
                </div>

                <div class="form-group">
                    <label for="usr">Author Name:</label>
                    <input type="text" class="form-control" name="author_name" id="author_name">
                    <button type="button" id="author_name_submit" class="btn btn-primary" name="author_name_button" style="margin-top: 15px">Apply
                    </button>
                </div>
            </div>
            <div class="col-sm-10">
                <div>
                    <h1 class="result-heading">Blogs in the system</h1>
                </div>
                <div style="margin-top: 20px">
                    <ul class="list-group">
                        @foreach ($blogs as $blog)
                            <li class="list-group-item">
                                <div>
                                    <h3>{{ $blog->title }}</h3>
                                </div>
                                <div style="word-break: break-all">
                                    {{ $blog->blogtext }}
                                </div>
                                <div style="margin-top: 20px">
                                    <span><strong>written by</strong></span> {{ucfirst($blog->author)}}
                                    <span><strong> on </strong></span> {{ucfirst($blog->date_created)}}
                                </div>
                            </li>
                            <br/>
                            <br/>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-scripts')
    <script type="text/javascript">
        jQuery('#datepicker').datepicker();
        //javascript function where sending ajax request with list of categories Ids.
        $('#categories').on('hidden.bs.select', function (data, e) {
            applyFilter();
        });
        //tracking event for author_name FilterController
        $('#author_name_submit').click(function () {
            applyFilter();
        });

        //sending ajax request
        function applyFilter() {
            var category_ids = $('#categories').val();
            var date = $('#datepicker').val() ? $('#datepicker').val() : null;
            var author_name = $('#author_name').val() ? $('#author_name').val() : null;
            var url = "{{route('filterByCategory')}}";
            var token = "{{csrf_token()}}";
            $.post(
                url,
                {
                    'category_ids': category_ids,
                    'date': date,
                    'author_name': author_name, _token: token
                },
                function (status) {
                    appendtheList(status, 'Category');
                }
            );
        }

        //calling the function at three places so made a single function instead
        function appendtheList(status, filter) {
            $('.result-heading').html('<h1>Result based on ' + filter + ' filter </h1>')
            $('.list-group').html('');
            $.each(status, function (index, value) {
                $.each(value, function (index, value) {
                    var Html = '<li class="list-group-item">' +
                        '<div>\n' +
                        '<h3>'+value.title+'</h3>\n' +
                        '</div>' +
                        '<div> ' + value.blogtext +
                        '</div>' +
                        '<div style="margin-top: 20px">' +
                        '<span><strong>written by </strong></span>' + value.author +
                        '<span><strong> on </strong></span>' + value.date_created +
                        '</div>' +
                        '</li><br/><br/>'
                    $('.list-group').prepend(Html);
                });
            })
        }
    </script>
@endsection

