{{--
    route名を指定して使用
    使用例(引数の定義方法に注意)
    <x-user.search route="user.search"/>
--}}

<form action="{{ route($route) }}" class="form-inline pr-3" method="get">
    <input name="free_word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索" value={{isset($_GET['free_word'])?$_GET['free_word']:''}}>
    <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
</form>