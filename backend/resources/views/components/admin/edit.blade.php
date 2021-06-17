
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{$title}}情報編集</div>
                <div class="card-body">
                    <form action="{{route('admin.'.$type.'.update',[$type => $prop])}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">名前</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                value="{{ $prop->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
