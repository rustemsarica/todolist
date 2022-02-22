<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 mt-2">
                <div class="input-group mb-3">
                    <input name="search" maxlength="300" pattern=".*\S+.*" id="input_search" type="text" class="form-control" placeholder="Ara" aria-label="Ara" aria-describedby="button-addon2" required autocomplete="off">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Ara</button>
                </div>
                <div id="response_search_results" class="search-results-ajax"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->task}}</td>
                                <td><button data-id="{{$item->id}}" class="btn btn-primary btn-status">{{$item->status}}</button></td>
                                <td>{{$item->created_at}}</td>
                                <td><button data-id="{{$item->id}}" class="btn btn-danger btn-delete">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('task.store') }}" method="POST" >
                @csrf
                <input type="text" name="task" id="">
                <button type="submit">Kaydet</button>
            </form>
        </div>
    </div> 
    
</body>
<script type="text/javascript"> 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".btn-delete").click(function(e){
  
        e.preventDefault();
   
        var id = $(this).data('id');
   
        $.ajax({
           type:'POST',
           url:"{{ route('ajaxRequest.delete') }}",
           data:{id:id},
           success:function(data){
                location.reload();
           }
        });
  
    });

    $(".btn-status").click(function(e){
  
        e.preventDefault();

        var id = $(this).data('id');
        
        $.ajax({
            type:'POST',
            url:"{{ route('ajaxRequest.status') }}",
            data:{id:id},
            success:function(data){
                location.reload();
            }
        });

    });

    $(document).on("input", "#input_search", function () {
        var input_value = $(this).val();
        if ( input_value) {
            search_tasks( input_value);
        }
    });

    function search_tasks( input_value) {
        var content_id = 'response_search_results';
        if (input_value.length < 2) {
            $('#' + content_id).hide();
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: "{{ route('ajaxRequest.search') }}",
            data: {input_value:input_value},
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    document.getElementById(content_id).innerHTML = obj.response;
                    $('#' + content_id).show();
                }
               
            }
        });
    }
</script>
</html>