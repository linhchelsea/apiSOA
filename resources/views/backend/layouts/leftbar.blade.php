<section class="sidebar">
    <ul class="sidebar-menu" id="list_pages">
        <li class="{{ Request::is('home')? 'active' : '' }}">
            <a href="{{ route('home') }}">
                <i class="fa fa-home"></i> <span>Home page</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/users*')? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="fa fa-user" aria-hidden="true"></i> <span>Users</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/lessons*')? 'active' : '' }}">
            <a href="{{ route('lessons.index') }}">
                <i class="fa fa-list" aria-hidden="true"></i> <span>Lessons</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/vocabularies*')? 'active' : '' }}">
            <a href="{{ route('vocabularies.index') }}">
                <i class="fa fa-pencil" aria-hidden="true"></i> <span>Vocabularies</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/topic*')? 'active' : '' }}">
            <a href="{{ route('topics.index') }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Topic</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/sentences*')? 'active' : '' }}">
            <a href="{{ route('sentences.index') }}">
                <i class="fa fa-comment" aria-hidden="true"></i> <span>Sentences</span>
            </a>
        </li>

    </ul>
</section>