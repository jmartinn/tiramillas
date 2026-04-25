@extends('layouts.app')

@section('titulo', 'Súmate como negocio')

@section('hero')
    <section class="detail-hero">
        <div class="detail-hero-inner" style="text-align: center;">
            <nav class="breadcrumbs" style="justify-content: center;">
                <a href="{{ url('/') }}">Inicio</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <a href="{{ route('negocios.index') }}">Negocios</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <span class="current">Súmate</span>
            </nav>

            <h1 style="margin-left: auto; margin-right: auto;">
                Haz crecer tu negocio con turismo responsable
            </h1>
            <p style="max-width: 40rem; margin: 0 auto var(--space-6);">
                Únete a los negocios locales que conectan con viajeros comprometidos
                que valoran la autenticidad y apoyan las economías rurales.
            </p>

            <div class="actions" style="justify-content: center;">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Crear cuenta y registrar mi negocio
                    </a>
                @endguest
                @auth
                    <a href="{{ route('negocios.create') }}" class="btn btn-primary">
                        Registrar mi negocio
                    </a>
                @endauth
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="sumate-section">
        <h2>Elige tu plan</h2>
        <p>
            Planes flexibles que se adaptan a las necesidades de cada negocio,
            desde pequeños artesanos hasta grandes alojamientos rurales.
        </p>

        <div class="plan-grid">
            <div class="plan-card">
                <h3>Básico</h3>
                <p class="plan-description">Para empezar a dar visibilidad a tu negocio.</p>
                <p class="plan-price">Gratis</p>
                <ul class="plan-features">
                    <li>Perfil básico del negocio</li>
                    <li>Ubicación en el mapa</li>
                    <li>Hasta 5 fotos</li>
                    <li>Responder a reseñas</li>
                </ul>
                <div class="plan-cta">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-secondary btn-block">Empezar gratis</a>
                    @endguest
                    @auth
                        <a href="{{ route('negocios.create') }}" class="btn btn-secondary btn-block">Empezar gratis</a>
                    @endauth
                </div>
            </div>

            <div class="plan-card highlighted">
                <span class="plan-badge">Más popular</span>
                <h3>Pro</h3>
                <p class="plan-description">Para negocios que quieren destacar.</p>
                <p class="plan-price">19 € <small>/mes</small></p>
                <ul class="plan-features">
                    <li>Todo lo del plan Básico</li>
                    <li>Perfil destacado</li>
                    <li>Fotos ilimitadas</li>
                    <li>Insignia de verificado</li>
                    <li>Estadísticas de visitas</li>
                </ul>
                <div class="plan-cta">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-block">Probar 14 días gratis</a>
                    @endguest
                    @auth
                        <a href="{{ route('negocios.create') }}" class="btn btn-primary btn-block">Probar 14 días gratis</a>
                    @endauth
                </div>
            </div>

            <div class="plan-card">
                <h3>Premium</h3>
                <p class="plan-description">Para experiencias y alojamientos.</p>
                <p class="plan-price">49 € <small>/mes</small></p>
                <ul class="plan-features">
                    <li>Todo lo del plan Pro</li>
                    <li>Reservas integradas</li>
                    <li>Posición prioritaria</li>
                    <li>Soporte dedicado</li>
                    <li>Campañas promocionales</li>
                </ul>
                <div class="plan-cta">
                    <a href="mailto:hola@tiramillas.test" class="btn btn-secondary btn-block">Contactar con ventas</a>
                </div>
            </div>
        </div>
    </section>
@endsection
