@extends('layout.header')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar de usuario</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('update.user', ['id' => $user->id]) }}" method="POST" id="formEditUser">
                    @csrf

                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome:</label>
                            <input type="text" class="form-control" placeholder="Digite seu nome" name="name"
                                   value="{{ $user->name }}">
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email"
                                   value="{{ $user->email }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>CPF:</label>
                            <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf"
                                   value="{{ $user->profile->cpf }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>RG:</label>
                            <input type="text" class="form-control" id="rg" placeholder="Digite seu RG" name="rg"
                                   value="{{ $user->profile->rg }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Data de Nascimento:</label>
                            <input type="date" class="form-control" name="date_birth"
                                   value="{{ $user->profile->date_birth }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Estado Civil:</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="">Selecione</option>
                                <option value="single"   {{ $user->profile->marital_status === 'single' ? 'selected' : '' }}>Solteiro</option>
                                <option value="married"  {{ $user->profile->marital_status === 'married' ? 'selected' : '' }}>Casado</option>
                                <option value="divorced" {{ $user->profile->marital_status === 'divorced' ? 'selected' : '' }}>Divorciado</option>
                                <option value="widower"  {{ $user->profile->marital_status === 'widower' ? 'selected' : '' }}>Viúvo (a)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>CEP:</label>
                            <input type="text" class="form-control" id="zipcode" placeholder="Digite seu CEP"
                                   name="zipcode" value="{{ $user->profile->zipcode }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Logradouro:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $user->profile->address }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Número:</label>
                            <input type="number" class="form-control" id="number"
                                   placeholder="Digite o número de sua residência" name="number"
                                   value="{{ $user->profile->number }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Bairro:</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                   value="{{ $user->profile->neighborhood }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Cidade:</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   value="{{ $user->profile->city }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Estado:</label>
                            <input type="text" class="form-control" id="state" name="state"
                                   value="{{ $user->profile->state }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Unidade Federativa:</label>
                            <input type="text" class="form-control" id="uf" name="uf"
                                   value="{{ $user->profile->uf }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Número de Telefone:</label>
                            <input type="text" class="form-control" id="phone_number"
                                   placeholder="Digite seu Telefone / WhatsApp" name="phone_number"
                                   value="{{ $user->profile->phone_number }}">
                        </div>
                    </div>

                    <button type="submit" id="editUser" class="btn btn-success mt-3">Editar usuário</button>
                </form>
            </div>
        </div>
    </div>

@endsection
