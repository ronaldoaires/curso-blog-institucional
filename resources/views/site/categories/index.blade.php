@extends('site.layouts.app')

@section('title', 'Categorias — ' . config('app.name'))
@section('description', 'Navegue pelos artigos organizados por categoria.')

@section('content')

<!-- ============================================
     CATEGORIES — Listing
     ============================================ -->
<section id="categories" class="pt-16">
  <div class="container-section">
    <div class="text-center mb-12">
      <p class="text-primary font-semibold tracking-wide uppercase text-sm mb-4">
        Explore
      </p>
      <h1 class="text-3xl sm:text-4xl font-bold text-secondary mb-4">Categorias</h1>
      <p class="text-muted max-w-xl mx-auto">
        Encontre conteúdos específicos navegando pelas nossas categorias.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      @forelse ($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}"
           class="card block p-6 hover:border-primary transition-colors">
          <h2 class="text-xl font-bold text-secondary mb-2">
            {{ $category->name }}
          </h2>
          @if ($category->description)
            <p class="text-muted text-sm leading-relaxed mb-4">
              {{ Str::limit($category->description, 100) }}
            </p>
          @endif
          <span class="text-primary font-semibold text-sm">
            {{ $category->posts_count }}
            {{ $category->posts_count === 1 ? 'artigo' : 'artigos' }} →
          </span>
        </a>
      @empty
        <p class="text-muted text-center col-span-full">Nenhuma categoria encontrada.</p>
      @endforelse

    </div>

    {{-- Pagination --}}
    @if ($categories->hasPages())
      <div class="mt-12">
        {{ $categories->links() }}
      </div>
    @endif
  </div>
</section>
<!-- END CATEGORIES -->

@endsection