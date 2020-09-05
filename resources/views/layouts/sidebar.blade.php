<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full">Laravel Project</div>
        <div class="c-sidebar-brand-minimized">Project</div>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('dashboard')}}">
                <span class="c-sidebar-nav-icon"><i class="fas fa-tachometer-alt"></i></span>
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-title">Project</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('project')}}">
                <span class="c-sidebar-nav-icon"><i class="fas fa-project-diagram"></i></span>
                Project
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('project-details')}}">
                <span class="c-sidebar-nav-icon"><i class="fas fa-file-alt"></i></span>
                Project Details
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
