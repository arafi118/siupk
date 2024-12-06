
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner"><br><br>
            <hr class="horizontal light mt-0">
        <ul class="vertical-nav-menu">
            @include('layouts.menu', ['parent_menu' => Session::get('menu')])
        </ul>
    </div>
</div>
