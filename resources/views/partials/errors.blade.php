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
