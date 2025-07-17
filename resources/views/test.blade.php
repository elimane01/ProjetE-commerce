@extends('layouts.app')

@section('title', 'Test Authentification')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Test d'Authentification</h4>
                </div>
                <div class="card-body">
                    @if(Auth::check())
                        <div class="alert alert-success">
                            <h5>✅ Vous êtes connecté !</h5>
                            <p><strong>Nom :</strong> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Rôle :</strong> {{ Auth::user()->role }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <h5>❌ Vous n'êtes pas connecté</h5>
                            <p>Vous devez vous connecter pour voir votre nom dans la navigation.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i>S'inscrire
                            </a>
                        </div>
                    @endif

                    <hr>

                    <h6>Utilisateurs dans la base de données :</h6>
                    <ul class="list-group">
                        @foreach(App\Models\User::all() as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <span class="badge bg-primary">{{ $user->role }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 