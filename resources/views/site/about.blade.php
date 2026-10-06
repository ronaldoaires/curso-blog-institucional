@extends('site.layouts.app')

@section('title', 'Sobre nós - ' . config('app.name'))
@section('description', "Conheça a história, missão e valores da nossa empresa. Descubra como transformamos ideias em soluções inovadoras para impulsionar o sucesso dos nossos clientes.")

@section('content')
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
@endsection