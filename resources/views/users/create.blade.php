@extends('layout.header')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cadastro de usuários</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('store.user') }}" method="POST" id="formCreateUser">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome:</label>
                            <input type="text" class="form-control" placeholder="Digite seu nome" name="name">
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>CPF:</label>
                            <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>RG:</label>
                            <input type="text" class="form-control" id="rg" placeholder="Digite seu RG" name="rg">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Data de Nascimento:</label>
                            <input type="date" class="form-control" name="date_birth">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Estado Civil:</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="">Selecione</option>
                                <option value="single">Solteiro</option>
                                <option value="married">Casado</option>
                                <option value="divorced">Divorciado</option>
                                <option value="widower">Viúvo (a)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>CEP:</label>
                            <input type="text" class="form-control" id="zipcode" placeholder="Digite seu CEP"
                                   name="zipcode">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Logradouro:</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Número:</label>
                            <input type="number" class="form-control" id="number"
                                   placeholder="Digite o número de sua residência" name="number">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Bairro:</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Cidade:</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Estado:</label>
                            <input type="text" class="form-control" id="state" name="state">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Unidade Federativa:</label>
                            <input type="text" class="form-control" id="uf" name="uf">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Número de Telefone:</label>
                            <input type="text" class="form-control" id="phone_number"
                                   placeholder="Digite seu Telefone / WhatsApp" name="phone_number">
                        </div>
                    </div>

                    <button type="submit" id="createUser" class="btn btn-success mt-3">Cadastrar usuário</button>
                </form>
            </div>
        </div>
    </div>

@endsection
