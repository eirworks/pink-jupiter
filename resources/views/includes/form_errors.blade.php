@if($errors->any())
    <div class="card border-danger bg-danger text-white my-2">
        <div class="card-body">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
