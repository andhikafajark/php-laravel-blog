@include(($module->getLowerName() ?? '') . '::components.tailwindcss.organisms.header.pages')

@include(($module->getLowerName() ?? '') . '::components.tailwindcss.organisms.topbar.pages')

<main>

    @yield('content')

</main>

@include(($module->getLowerName() ?? '') . '::components.tailwindcss.organisms.footer.pages')
