@extends('layout.header')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Lista de usuário</h1>
        <p class="mb-4">Confira abaixo a lista de usuários cadastrados em nossa base de dados
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Usuários</h5>
                <a href="{{ route('create.user') }}">
                    <button class="btn btn-primary">Cadastrar Usuários</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="listUsers">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Data Nascimento</th>
                            <th>Endereço / Número</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
