<section class="sidebar">
    <ul class="sidebar-menu" id="list_pages">
        {{--<li class="{{ Request::is('home')? 'active' : '' }}">--}}
            {{--<a href="{{ route('home') }}">--}}
                {{--<i class="fa fa-home"></i> <span>Home page</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        <li class="{{ Request::is('admin/users*')? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="fa fa-home"></i> <span>Users</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/lessons*')? 'active' : '' }}">
            <a href="{{ route('lessons.index') }}">
                <i class="fa fa-home"></i> <span>Lessons</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/topic*')? 'active' : '' }}">
            <a href="{{ route('topics.index') }}">
                <i class="fa fa-home"></i> <span>Topic</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/sentences*')? 'active' : '' }}">
            <a href="{{ route('sentences.index') }}">
                <i class="fa fa-home"></i> <span>Sentences</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/user-learnt*')? 'active' : '' }}">
            <a href="{{ route('user-learnt.index') }}">
                <i class="fa fa-home"></i> <span>User Learn</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/vocabularies*')? 'active' : '' }}">
            <a href="{{ route('vocabularies.index') }}">
                <i class="fa fa-home"></i> <span>Vocabularies</span>
            </a>
        </li>
    </ul>
</section>