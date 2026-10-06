@extends('site.layouts.app')

@section('title', 'Contato - ' . config('app.name'))

@section('content')

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
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
          />
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
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
          />
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
                   placeholder:text-muted/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"
          ></textarea>
        </div>

        <button type="submit" class="btn-primary w-full">Enviar mensagem</button>
      </form>
    </div>
  </div>
</section>
<!-- END CONTACT -->

@endsection

