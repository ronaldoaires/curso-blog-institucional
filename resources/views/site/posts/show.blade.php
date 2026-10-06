@extends('site.layouts.app')

@section('title', $post->title . ' — ' . config('app.name'))
@section('description', Str::limit(strip_tags($post->content), 150))

@section('content')

<!-- ============================================
     POST — Single
     ============================================ -->
<article id="post" class="pt-16">
  <div class="container-section">
    <div class="max-w-3xl mx-auto">

      {{-- Breadcrumb --}}
      <nav class="text-sm text-muted mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('posts.index') }}" class="hover:text-primary transition-colors">Artigos</a>
        @if ($post->category)
          <span class="mx-2">/</span>
          <a href="{{ route('categories.show', $post->category->slug) }}" class="hover:text-primary transition-colors">
            {{ $post->category->name }}
          </a>
        @endif
      </nav>

      {{-- Header --}}
      <header class="mb-8">
        @if ($post->category)
          <a href="{{ route('categories.show', $post->category->slug) }}"
             class="inline-block text-xs font-semibold uppercase tracking-wide text-primary mb-3 hover:text-primary-dark transition-colors">
            {{ $post->category->name }}
          </a>
        @endif

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-secondary leading-tight mb-4">
          {{ $post->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-muted">
          <time datetime="{{ $post->created_at->toDateString() }}">
            {{ $post->created_at->format('d/m/Y') }}
          </time>
          @if ($post->author)
            <span>•</span>
            <span>{{ $post->author }}</span>
          @endif
          <span>•</span>
          <span>{{ $post->views }} {{ $post->views === 1 ? 'visualização' : 'visualizações' }}</span>
        </div>
      </header>

      {{-- Cover --}}
      <div class="h-64 sm:h-80 bg-gradient-to-br from-primary to-primary-dark rounded-xl mb-10"></div>

      {{-- Content --}}
      <div class="prose prose-slate max-w-none text-muted leading-relaxed space-y-4">
        {!! nl2br(e($post->content)) !!}
      </div>

      {{-- Back link --}}
      <div class="mt-12 pt-8 border-t border-border">
        <a href="{{ route('posts.index') }}"
           class="text-primary font-semibold text-sm hover:text-primary-dark transition-colors">
          ← Voltar para todos os artigos
        </a>
      </div>
    </div>

    {{-- Related posts --}}
    @if ($relatedPosts->isNotEmpty())
      <div class="max-w-6xl mx-auto mt-16 pt-16 border-t border-border">
        <h2 class="text-2xl sm:text-3xl font-bold text-secondary mb-8 text-center">
          Artigos relacionados
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach ($relatedPosts as $related)
            <article class="card">
              <div class="h-48 bg-gradient-to-br from-primary to-primary-dark"></div>
              <div class="p-6">
                <time class="text-sm text-muted" datetime="{{ $related->created_at->toDateString() }}">
                  {{ $related->created_at->format('d/m/Y') }}
                </time>
                <h3 class="text-xl font-bold text-secondary mt-2 mb-3">
                  {{ $related->title }}
                </h3>
                <p class="text-muted text-sm leading-relaxed mb-4">
                  {{ Str::limit($related->content, 100) }}
                </p>
                <a href="{{ route('posts.show', $related->slug) }}"
                   class="text-primary font-semibold text-sm hover:text-primary-dark transition-colors">
                  Ler mais →
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</article>
<!-- END POST -->

@endsection