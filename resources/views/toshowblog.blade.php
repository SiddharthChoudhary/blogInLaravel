@include('Mainview')
<body>
<div class="container">
    @yield('navbar')
    <div class="row">
    <div class="col-sm-2">

        <h3>Filters</h3>
        <div class="form-group">
            <select id="categories" data-size="5" data-selected-text-format="count > 4" multiple class="selectpicker form-control show-tick" name="category[]" title="category" required>
                @foreach($categories as $category)
                    <option  title="{{$category->category_name}}" data-tokens="{{$category->id}}" value="{{$category->id}}">{{$category->category_name}}
                        </option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
            <label>Select Date</label>
            <input id="datepicker" name="date_selected" data-provide="datepicker">
            <button type="button" id="datepicker_applybutton" class="btn btn-primary" name="author_name_button">Apply
            </button>
        </div>
        <div class="form-group">
            <label for="usr">Author Name:</label>
            <input type="text" name="author_name" id="author_name">
            <button type="button" id="author_name_submit" class="btn btn-primary" name="author_name_button">Apply
            </button>
        </div>
    </div>
    <div class="col-sm-10">
        <div>
        <h1 class="result-heading">Blogs in the system</h1>
        </div>
           <div style="margin-top: 20px">
            <ul class="list-group">
            @foreach ($result as $task)
                <li class="list-group-item">
                    <div>
                    {{ $task->blogtext }}
                    </div>
                    <div style="margin-top: 20px">
                        <span><strong>written by</strong></span> {{ucfirst($task->author)}}
                        <span><strong>on </strong></span> {{ucfirst($task->date_created)}}

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
<script type="text/javascript">
    $('#datepicker').datepicker();
//javascript functions where sending ajax request with list of categories Ids.
    $('#categories').on('hidden.bs.select', function (data,e) {
        var category_ids = $('#categories').val();
            var url = "{{route('filterByCategory')}}";
            var token = "{{csrf_token()}}";
            $.post(
                url,
                {'category_ids': category_ids, _token: token},
                function (status) {
                    appendtheList(status,'Category');
                }
            );

    });
    //function where sending the selected date from the datepicker
    $('#datepicker_applybutton').click(function () {
        if ($('#datepicker').val()) {
            var date = $('#datepicker').val();
            var url = "{{route('filterByDate')}}";
            var token = "{{csrf_token()}}";
            $.post(url,
                {'date': date, _token: token},
                function (status) {
                    appendtheList(status,'Date')

                }
            );
        }
    });

    //function where author name is being sent at the FilterController
    $('#author_name_submit').click(function () {
        var author_name = $('#author_name').val();
        if (author_name) {
            var url = "{{route('filterByAuthor')}}";
            var token = "{{csrf_token()}}";
            $.post(url,
                {'author_name': author_name, _token: token},
                function (status) {
                    appendtheList(status,'Author')
                }
            )
        }

    });
    //calling the function at three places so made a single function instead
    function appendtheList(status,filter){
        $('.result-heading').html('<h1>Result based on '+ filter+' filter </h1>')
        $('.list-group').html('');
        $.each(status, function (index, value) {
            $.each(value, function (index, value) {
                var Html = '<li class="list-group-item">' +
                    '                    <div> ' +value.blogtext+
                    '                    </div>' +
                    '                    <div style="margin-top: 20px">' +
                    '                        <span><strong>written by </strong></span>' +value.author+
                    '                        <span><strong>on </strong></span>' +value.date_created+
                    '                    </div>' +
                    '                </li><br/><br/>'
                $('.list-group').prepend(Html);
            });
        })
    }
</script>

