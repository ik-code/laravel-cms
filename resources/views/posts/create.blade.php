@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endsection
@section('content')
    <div class="card" >
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ isset($post) ? route('posts.update', $post->id)  : route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" cols="5" rows="5" >{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea type="text" class="form-control post_content" id="post_content" name="post_content" cols="5" rows="5" >{{ isset($post) ? $post->post_content : '' }}</textarea>
                </div>
                <div class="form-group post__datepicker">
                    <label for="published_at">Published at</label>
                    <input type="text" class="form-control datepicker" id="published_at" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" value="{{ isset($post) ? $post->image : '' }}">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="sumbit" class="btn btn-success btn-sm">
                        {{ isset($post) ? 'Update Post' : 'Add Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            height: 400,
            selector: "textarea.post_content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };
        tinymce.init(editor_config);
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function(){
            $("#published_at").datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(datetext){
                    var d = new Date(); // for now
                    var h = d.getHours();
                    h = (h < 10) ? ("0" + h) : h ;

                    var m = d.getMinutes();
                    m = (m < 10) ? ("0" + m) : m ;

                    var s = d.getSeconds();
                    s = (s < 10) ? ("0" + s) : s ;

                    datetext = datetext + " " + h + ":" + m + ":" + s;
                    $('#published_at').val(datetext);
                },
            });
        });
    </script>
@endsection
