@extends('site.layouts.app')

@section('title', $category->name . ' — ' . config('app.name'))
@section('description', $category->description ?? 'Artigos da categoria ' . $category->name)

@section('content')

<!-- ============================================
     CATEGORY — Posts Listing
     ============================================ -->
<section id="category-posts" class="pt-16">
  <div class="container-section">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-muted mb-6">
      <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
      <span class="mx-2">/</span>
      <a href="{{ route('categories.index') }}" class="hover:text-primary transition-colors">Categorias</a>
      <span class="mx-2">/</span>
      <span class="text-secondary font-medium">{{ $category->name }}</span>
    </nav>

    <div class="text-center mb-12">
      <p class="text-primary font-semibold tracking-wide uppercase text-sm mb-4">
        Categoria
      </p>
      <h1 class="text-3xl sm:text-4xl font-bold text-secondary mb-4">
        {{ $category->name }}
      </h1>
      @if ($category->description)
        <p class="text-muted max-w-xl mx-auto">
          {{ $category->description }}
        </p>
      @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse ($posts as $post)
      <article class="card">
        <div class="h-48 bg-gradient-to-br from-primary to-primary-dark"></div>
        <div class="p-6">
          <time class="text-sm text-muted" datetime="{{ $post->created_at->toDateString() }}">
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
      <p class="text-muted text-center col-span-full">Nenhum artigo nesta categoria.</p>
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
<!-- END CATEGORY POSTS -->

@endsection