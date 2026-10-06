@extends('site.layouts.app')
@section('content')

<!-- ============================================
     HOME — Hero Section
     ============================================ -->
<section id="home" class="pt-16">
  <div class="container-section text-center">
    <p class="text-primary font-semibold tracking-wide uppercase text-sm mb-4">
      Bem-vindo ao nosso blog
    </p>
    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-tight mb-6">
      Insights que impulsionam<br class="hidden sm:inline"> o seu negócio
    </h1>
    <p class="text-muted text-lg max-w-2xl mx-auto mb-10">
      Compartilhamos conhecimento, tendências e estratégias para ajudar
      sua empresa a crescer com confiança no mercado digital.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="#blog" class="btn-primary">Ver artigos</a>
      <a href="#contato" class="btn-secondary">Fale conosco</a>
    </div>
  </div>
</section>
<!-- END HOME -->


<!-- ============================================
     BLOG — Post Listing
     ============================================ -->
<section id="blog" class="bg-surface">
  <div class="container-section">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-secondary mb-4">Últimos artigos</h2>
      <p class="text-muted max-w-xl mx-auto">
        Fique por dentro das novidades e conteúdos exclusivos preparados pela nossa equipe.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse ($posts as $post)
      <!-- Post 1 -->
      <article class="card">
        <div class="h-48 bg-gradient-to-br from-primary to-primary-dark"></div>
        <div class="p-6">
          <time class="text-sm text-muted" datetime="2026-09-10">
            {{ $post->created_at->format('d/m/Y') }}
          </time>
          <h3 class="text-xl font-bold text-secondary mt-2 mb-3">
            {{ $post->title }}
          </h3>
          <p class="text-muted text-sm leading-relaxed mb-4">
            {{ Str::limit($post->content, 100) }}
          </p>
          <a href="{{ route('posts.show', $post->slug) }}" class="text-primary font-semibold text-sm hover:text-primary-dark transition-colors">
            Ler mais →
          </a>
        </div>
      </article>
      @empty
      <p class="text-muted text-center col-span-full">Nenhum artigo encontrado.</p>
      @endforelse



    </div>
  </div>
</section>
<!-- END BLOG -->


<!-- ============================================
     SOBRE — About Section
     ============================================ -->
<section id="sobre">
  <div class="container-section">
    <div class="max-w-3xl mx-auto">
      <h2 class="text-3xl sm:text-4xl font-bold text-secondary mb-6">Sobre nós</h2>
      <div class="space-y-4 text-muted leading-relaxed">
        <p>
          Somos uma empresa dedicada a oferecer soluções inovadoras que
          conectam pessoas e negócios. Com mais de 10 anos de experiência
          no mercado, nossa missão é transformar ideias em resultados
          concretos e mensuráveis.
        </p>
        <p>
          Nossa equipe é formada por profissionais apaixonados por tecnologia,
          design e estratégia. Acreditamos que o conhecimento compartilhado
          é a base para o crescimento sustentável — e é por isso que
          mantemos este blog, para contribuir com a comunidade e
          fortalecer o ecossistema empreendedor.
        </p>
        <p>
          Trabalhamos com transparência, compromisso e foco nas necessidades
          de cada cliente, buscando sempre superar expectativas e entregar
          valor real em cada projeto.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- END SOBRE -->


<!-- ============================================
     CONTACT — Contact Form
     ============================================ -->
<section id="contact" class="bg-surface">
  <div class="container-section">
    <div class="max-w-xl mx-auto">
      <div class="text-center mb-10">
        <h2 class="text-3xl sm:text-4xl font-bold text-secondary mb-4">Entre em contato</h2>
        <p class="text-muted">
          Tem alguma dúvida ou sugestão? Envie sua mensagem e retornaremos em breve.
        </p>
      </div>

      <form action="#" method="POST" class="space-y-6">
        <div>
          <label for="nome" class="block text-sm font-semibold text-secondary mb-2">Nome</label>
          <input
            type="text"
            id="nome"
            name="nome"
            required
            placeholder="Seu nome completo"
            class="w-full px-4 py-3 rounded-lg border border-border bg-white text-secondary
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition" />
        </div>

        <div>
          <label for="email" class="block text-sm font-semibold text-secondary mb-2">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            required
            placeholder="seu@email.com"
            class="w-full px-4 py-3 rounded-lg border border-border bg-white text-secondary
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition" />
        </div>

        <div>
          <label for="mensagem" class="block text-sm font-semibold text-secondary mb-2">Mensagem</label>
          <textarea
            id="mensagem"
            name="mensagem"
            rows="5"
            required
            placeholder="Escreva sua mensagem..."
            class="w-full px-4 py-3 rounded-lg border border-border bg-white text-secondary
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"></textarea>
        </div>

        <button type="submit" class="btn-primary w-full">Enviar mensagem</button>
      </form>
    </div>
  </div>
</section>
<!-- END CONTACT -->

@endsection