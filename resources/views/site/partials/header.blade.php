<nav class="fixed top-0 left-0 w-full bg-white/95 backdrop-blur-sm border-b border-border z-50">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo -->
      <a href="{{ route('home') }}" class="text-xl font-bold text-secondary tracking-tight">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
      </a>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center gap-8">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <a href="{{ route('posts.index') }}" class="nav-link">Artigos</a>
        <a href="{{ route('categories.index') }}" class="nav-link">Categorias</a>
        <a href="{{ route('about') }}" class="nav-link">Sobre</a>
        <a href="{{ route('contact') }}" class="nav-link">Contato</a>
      </div>

      <!-- Mobile hamburger button -->
      <button id="menu-toggle" class="md:hidden p-2 text-secondary" aria-label="Abrir menu">
        <!-- Icon open (hamburger) -->
        <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <!-- Icon close (X) -->
        <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile menu panel -->
  <div id="mobile-menu" class="hidden md:hidden border-t border-border bg-white">
    <div class="flex flex-col px-4 py-4 gap-4">
      <a href="{{ route('home') }}" class="nav-link mobile-nav-link">Home</a>
      <a href="{{ route('posts.index') }}" class="nav-link mobile-nav-link">Artigos</a>
      <a href="{{ route('categories.index') }}" class="nav-link mobile-nav-link">Categorias</a>
      <a href="{{ route('about') }}" class="nav-link mobile-nav-link">Sobre</a>
      <a href="{{ route('contact') }}" class="nav-link mobile-nav-link">Contato</a>
    </div>
  </div>
</nav>