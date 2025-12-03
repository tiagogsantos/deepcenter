<script type="text/javascript">

    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00');
        $('#phone_number').mask('(00) 00000-0000');
        $('#rg').mask('00.000.000-0');
        $('#zipcode').mask('00000-000');

        listUsers();
    });

    // Listagem de usuários
    function listUsers() {

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            url: "{{ route('list.users') }}",
            type: "GET",
            dataType: 'json',
            data: {},
            success: function (response) {

                if (response.error === '') {
                    Swal.fire({
                        title: 'Atenção!',
                        text: response.mensagem,
                        icon: 'error'
                    });

                    return false;
                }

                const obj = [];

                $.each(response, (value, item) => {

                    let dataUsers = '';

                    let viewUsersEdit = "{{ route('edit.user', ['id' => ':id']) }}".replace(':id', item.id);

                    dataUsers += `<div class="btn-group">`;
                    dataUsers += `<a href="${viewUsersEdit}" class='btn btn-sm btn-outline-primary mr-2' title="Editar Usuário">`;
                    dataUsers += `<i class="fas fa-edit"></i>`;
                    dataUsers += `</a>`;
                    dataUsers += `<button onclick="removeUser(${item.id})" class='btn btn-sm btn-outline-danger mr-2' title="Remover Usuário">`;
                    dataUsers += `<i class="fas fa-trash"></i>`;
                    dataUsers += `</button>`;
                    dataUsers += `</div>`;

                    obj.push([
                        item.name,
                        item.email,
                        formatData(item.profile.date_birth),
                        item.profile.address + ' - ' + item.profile.number,
                        formatPhone(item.profile.phone_number),
                        dataUsers
                    ]);
                });

                $("#listUsers tbody").remove();

                $("#listUsers").dataTable({
                    destroy: true,
                    data: obj,
                    pageLength: 10,
                    bLengthChange: false,
                    bFilter: false,
                    responsive: true,
                    searching: true,
                    sLengthMenu: false,
                    info: false,
                    sorting: false,
                    processing: true,
                    loading: true,
                    language: {
                        sSearch: "Pesquisar:",
                        oPaginate: {
                            sNext: "Próximo",
                            sPrevious: "Anterior"
                        }
                    }
                });
            },
            error: function (data) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Erro ao retornas a listagem de usuários.'
                });
            },
        })
    }

    // Dados de busca de CEP
    $('input[name=zipcode]').on('blur', function () {

        let cep = $(this).val().replace(/\D/g, '');

        if (cep.length === 8) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $.ajax({
                url: "{{ route('list.cep') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    cep: cep
                },
                success: function (result) {
                    if (!("erro" in result)) {
                        $('input[name=address]').val(result.logradouro);
                        $('input[name=neighborhood]').val(result.bairro);
                        $('input[name=state]').val(result.estado);
                        $('input[name=city]').val(result.localidade);
                        $('input[name=uf]').val(result.uf);
                        $('input[name=numero]').focus();
                        $("#address").prop('readonly', true);
                        $("#neighborhood").prop('readonly', true);
                        $("#city").prop('readonly', true);
                        $("#state").prop('readonly', true);
                        $("#uf").prop('readonly', true);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'CEP não encontrado, por favor preencha um CEP válido.'
                        });
                        $("#address").prop('readonly', false);
                        $("#neighborhood").prop('readonly', false);
                        $("#city").prop('readonly', false);
                        $("#uf").prop('readonly', false);
                        $("#state").prop('readonly', false);
                    }
                },
                error: function (data) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Erro ao consultar o CEP. Por favor, tente novamente.'
                    });
                },
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'CEP inválido. Por favor, preencha um CEP válido.'
            });
        }
    });

    // Criação de usuário
    $("#createUser").on('click', function (e) {

        e.preventDefault();

        $.ajax({
            url: "{{ route('store.user') }}",
            method: 'POST',
            dataType: 'json',
            data: $("#formCreateUser").serialize(),
        }).done(response => {

            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: response.message
                });
            }

            if (response.status === 'error') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ooops!',
                    text: response.message
                });
            }
        }).fail(xhr => {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                let errors = xhr.responseJSON.errors;

                // Extrai todas as mensagens de erro
                let allErrorMessages = [];
                for (let field in errors) {
                    if (errors[field][0]) {
                        allErrorMessages.push(`• ${errors[field][0]}`);
                    }
                }

                Swal.fire({
                    title: 'Campos obrigatórios',
                    html: 'Verifique os seguintes campos:<br>' + allErrorMessages.join('<br>'),
                    icon: 'warning'
                });

            } else {
                Swal.fire('Erro', 'Não foi possível registrar o usuário.', 'error');
            }
        });
    });

    $("#editUser").on('click', function (e) {

        e.preventDefault();

        let userID = $("#user_id").val();

        $.ajax({
            url: "{{ route('update.user', ['id' => ':id']) }}".replace(':id', userID),
            method: 'POST',
            dataType: 'json',
            data: $("#formEditUser").serialize(),
        }).done(response => {

            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: response.message
                });
            }

            if (response.status === 'error') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ooops!',
                    text: response.message
                });
            }
        }).fail(xhr => {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                let errors = xhr.responseJSON.errors;

                // Extrai todas as mensagens de erro
                let allErrorMessages = [];
                for (let field in errors) {
                    if (errors[field][0]) {
                        allErrorMessages.push(`• ${errors[field][0]}`);
                    }
                }

                Swal.fire({
                    title: 'Campos obrigatórios',
                    html: 'Verifique os seguintes campos:<br>' + allErrorMessages.join('<br>'),
                    icon: 'warning'
                });

            } else {
                Swal.fire('Erro', 'Não foi possível registrar o usuário.', 'error');
            }
        });
    });

    // Remoção de usuário
    function removeUser(id) {
        Swal.fire({
            icon: 'info',
            title: "Tem certeza que deseja excluir o usuário?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Sim, tenho certeza",
            denyButtonText: `Não, quero cancelar a exclusão`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('destroy.user') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function (response) {

                        if (response.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops..',
                                text: response.message
                            });

                            return false;
                        }

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.message
                            });

                            listUsers();
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Exclusão não realizada!", "", "info");
            }
        });
    }

    /* Inicio Helpers */
    function formatPhone(telefone) {
        return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
    }

    function formatData(data) {
        if (!data) return '';
        const partes = data.split("-");
        return partes[2] + "/" + partes[1] + "/" + partes[0];
    }

    /* Fim Helpers */

</script>
