<form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left:10px;">
    @csrf
    <button type="submit">Logout</button>
</form>