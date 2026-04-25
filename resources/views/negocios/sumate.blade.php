@extends('layouts.app')

@section('titulo', 'Súmate como negocio')

@section('content')
    <div class="sumate">
        <header class="sumate-hero">
            <h1>Haz crecer tu negocio con turismo responsable</h1>
            <p>
                Únete a los negocios locales que conectan con viajeros comprometidos
                que valoran la autenticidad y apoyan las economías rurales.
            </p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary">Crear cuenta y registrar mi negocio</a>
            @endguest
            @auth
                <a href="{{ route('negocios.create') }}" class="btn btn-primary">Registrar mi negocio</a>
            @endauth
        </header>

        <section class="sumate-planes">
            <h2>Planes</h2>
            <div class="card-list">
                <div class="card">
                    <h3>Básico</h3>
                    <p class="card-meta">Gratis</p>
                    <p>Para empezar a dar visibilidad a tu negocio.</p>
                    <ul class="plan-features">
                        <li>Perfil básico del negocio</li>
                        <li>Ubicación en el mapa</li>
                        <li>Hasta 5 fotos</li>
                        <li>Responder a reseñas</li>
                    </ul>
                </div>

                <div class="card card-highlighted">
                    <h3>Pro</h3>
                    <p class="card-meta">19 €/mes</p>
                    <p>Para negocios que quieren destacar.</p>
                    <ul class="plan-features">
                        <li>Todo lo del plan Básico</li>
                        <li>Perfil destacado</li>
                        <li>Fotos ilimitadas</li>
                        <li>Insignia de verificado</li>
                        <li>Estadísticas de visitas</li>
                    </ul>
                </div>

                <div class="card">
                    <h3>Premium</h3>
                    <p class="card-meta">49 €/mes</p>
                    <p>Para experiencias y alojamientos.</p>
                    <ul class="plan-features">
                        <li>Todo lo del plan Pro</li>
                        <li>Reservas integradas</li>
                        <li>Posición prioritaria</li>
                        <li>Soporte dedicado</li>
                        <li>Campañas promocionales</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
