<ul class="nav">
    <li class="{{ (\Illuminate\Support\Facades\Request::path() === '/') ? 'active' : '' }}">
        <a href="/">
            Welcome
        </a>
    </li>
    <li class="{{ \Illuminate\Support\Facades\Request::is('admin') ? 'active' : '' }}">
        <a href="/admin">
            Home
        </a>
    </li>
    <li class="{{ \Illuminate\Support\Facades\Request::is('admin/create') ? 'active' : '' }}">
        <a href="/admin/create">
            Add Product
        </a>
    </li>
    @can('access', auth()->user())
        <li class="{{ \Illuminate\Support\Facades\Request::is('admin/category/create') ? 'active' : '' }}">
            <a href="/admin/category/create">
                Add Category
            </a>
        </li>
        <li class="{{ \Illuminate\Support\Facades\Request::is('admin/attribute') ? 'active' : '' }}">
            <a href="/admin/attribute">
                Attributes
            </a>
        </li>
        <li class="{{ \Illuminate\Support\Facades\Request::is('admin/userDetails') ? 'active' : '' }}">
            <a href="/admin/userDetails">
                User details
            </a>
        </li>
    @endcan
</ul>
