@extends('site.layouts.app')

@section('title', 'Artigos — ' . config('app.name'))
@section('description', 'Confira todos os nossos artigos publicados.')

@section('content')

<!-- ============================================
     POSTS — Listing
     ============================================ -->
<section id="posts" class="pt-16">
  <div class="container-section">
    <div class="text-center mb-12">
      <p class="text-primary font-semibold tracking-wide uppercase text-sm mb-4">
        Blog
      </p>
      <h1 class="text-3xl sm:text-4xl font-bold text-secondary mb-4">Todos os artigos</h1>
      <p class="text-muted max-w-xl mx-auto">
        Explore nossa coleção completa de conteúdos preparados com cuidado para você.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse ($posts as $post)
      <article class="card">
        <div class="h-48 bg-gradient-to-br from-primary to-primary-dark"></div>
        <div class="p-6">
          @if ($post->category)
            <a href="{{ route('categories.show', $post->category->slug) }}"
               class="inline-block text-xs font-semibold uppercase tracking-wide text-primary mb-2 hover:text-primary-dark transition-colors">
              {{ $post->category->name }}
            </a>
          @endif
          <time class="block text-sm text-muted" datetime="{{ $post->created_at->toDateString() }}">
            {{ $post->created_at->format('d/m/Y') }}
          </time>
          <h3 class="text-xl font-bold text-secondary mt-2 mb-3">
            {{ $post->title }}
          </h3>
          <p class="text-muted text-sm leading-relaxed mb-4">
            {{ Str::limit($post->content, 100) }}
          </p>
          <a href="{{ route('posts.show', $post->slug) }}"
             class="text-primary font-semibold text-sm hover:text-primary-dark transition-colors">
            Ler mais →
          </a>
        </div>
      </article>
      @empty
      <p class="text-muted text-center col-span-full">Nenhum artigo encontrado.</p>
      @endforelse

    </div>

    {{-- Pagination --}}
    @if ($posts->hasPages())
      <div class="mt-12">
        {{ $posts->links() }}
      </div>
    @endif
  </div>
</section>
<!-- END POSTS -->

@endsection