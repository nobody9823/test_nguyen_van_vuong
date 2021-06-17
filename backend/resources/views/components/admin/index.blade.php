<div class="card-header d-flex justify-content-between align-items-center">
    {{$title}}管理
    <a href='{{ route("admin.$type.create") }}' class="btn btn-primary mb-2">新規作成</a>
</div>
<div class="card-body">
    @if(count($props) <= 0) <p>{{$title}}データがありません。</p>
        @else
        <table class="table">
            <tr>
                <th>名前</th>
                <th>作成日</th>
                <th>更新日</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            @foreach($props as $prop)
            <tr>
                <td>{{ $prop->name }}</td>
                <td>{{ $prop->created_at }}</td>
                <td>{{ $prop->updated_at }}</td>
                <td><a class="btn btn-primary btn-sm"
                        href="{{route('admin.'.$type.'.edit',[$type => $prop])}}">編集</a>
                </td>
                <td>
                    <form action="{{route('admin.'.$type.'.destroy',[$type => $prop])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-cneter">
            {{ $props->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>
@endsection
