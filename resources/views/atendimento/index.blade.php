<x-layout.default>
    <div class="row">
        <div class="card h-auto">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="col-xl-6 col-md-12 mt-2 px-2 text-center">
                        <div class="card">
                            <h4>Atendimento Diário</h4>
                            <h1 id="diario-card" class="mr-2"></h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="col-xl-6 col-md-12 mt-2 px-2 text-center">
                        <div class="card">
                            <h4>Atendimento Semanal</h4>
                            <h1 id="semanal-card" class="mr-2"></h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="col-xl-6 col-md-12 mt-2 px-2 text-center">
                        <div class="card">
                            <h4>Atendimento Mensal</h4>
                            <h1 id="mensal-card" class="mr-2"></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 bst-seller">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="heading mb-0">Novo atendimento</h2>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 bst-seller">
            <div class="card h-auto">
                <div class="card-body">
                    <form id="formAtendimento" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">CEP</label>
                                <input type="text" class="form-control cep-input" name="cep" id="cep"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">CPF</label>
                                <input type="text" class="form-control cpf-input" name="cpf" id="cpf" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Whatsapp</label>
                                <input type="text" class="form-control celular-input" name="whatsapp" id="whatsapp"
                                    required>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Contato</label>
                                <input type="text" class="form-control celular-input" name="contato" id="contato">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-12 m-b30">
                                <label class="form-label required">Como ficou sabendo da empresa?</label>
                                <select class="form-control selectpicker" name="como_nos_conheceu"
                                    id="como_nos_conheceu" data-live-search="true" required>
                                    <option>Selecione...</option>
                                    @foreach ($comoNosConheceu as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div id="button-container" class="col-sm-12">
                                <button id="btn-submit" class="btn btn-success btn-block" type="submit">Salvar</button>
                            </div>
                            <div id="edit-button-container" class="col-sm-9" style="display: none;">
                                <button id="btn-submit-edit" class="btn btn-primary btn-block"
                                    type="submit">Editar</button>
                            </div>
                            <div id="delete-button-container" class="col-sm-3" style="display: none;">
                                <button id="btn-delete" class="btn btn-danger btn-block" type="button">Excluir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 bst-seller">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="heading mb-0">Visualização</h4>
            </div>
            <div class="card h-auto">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1 dt-filter exports">
                        <div class="tbl-caption"></div>
                        <table id="customer-tbl" class="table shorting">
                            <thead>
                                <tr>
                                    <th>Editar</th>
                                    <th>CEP</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Whatsapp</th>
                                    <th>Contato</th>
                                    <th>Como nos conheceu</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.default>

<script>
    $(document).ready(function() {
        listData();
        carregaCards();
    });

    function listData() {
        $.ajax({
            url: "{{ route('atendimento.list') }}",
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.msg_type === 'success') {
                    let tbody = $('#customer-tbl tbody');
                    tbody.empty();

                    $.each(response.atendimentos, function(index, value) {
                        let tr = $("<tr></tr>");
                        let tdCheckbox = $('<td></td>');
                        let checkbox = $("<input>", {
                            type: 'checkbox',
                            value: value.id,
                            id: value.id,
                            name: "atendimento",
                        });

                        tdCheckbox.append(checkbox);
                        tr.append(tdCheckbox);

                        $('<td></td>').text(formataCEP(value.cep)).appendTo(tr);
                        $('<td></td>').text(value.nome).appendTo(tr);
                        $('<td></td>').text(formataCPF(value.cpf)).appendTo(tr);
                        $('<td></td>').text(formataContato(value.whatsapp)).appendTo(tr);
                        $('<td></td>').text(formataContato(value.contato)).appendTo(tr);
                        $('<td></td>').text(value.como_nos_conheceu).appendTo(tr).addClass(
                            'text-center');
                        tbody.append(tr);
                    });
                }
            }
        });
    }

    $('tbody').on('click', 'input[type="checkbox"]', function() {
        if ($(this).is(':checked')) {
            let id = $(this).attr('id');
            let urlShow = "{{ route('atendimento.show', ':id') }}";
            $.ajax({
                url: urlShow.replace(':id', id),
                type: "GET",
                success: function(response) {
                    if (response.msg_type === 'success') {
                        let valor = response.atendimento.como_nos_conheceu;
                        let select = $('#como_nos_conheceu');

                        $('#cep').val(response.atendimento.cep);
                        $('#nome').val(response.atendimento.nome);
                        $('#cpf').val(response.atendimento.cpf);
                        $('#whatsapp').val(response.atendimento.whatsapp);
                        $('#contato').val(response.atendimento.contato);
                        select.val(valor).change();
                        select.selectpicker('refresh');
                        let inputId = $('<input>').attr('type', 'hidden').attr('id',
                                'idAtendimento')
                            .attr('name', 'id').attr('value', response.atendimento.id);
                        $('#formAtendimento').append(inputId);
                    }
                    desmarcaCheckbox();
                    $('#button-container').hide();
                    $('#edit-button-container').show();
                    $('#delete-button-container').show();

                }
            });
        }
    });

    $('#btn-submit').click(function(e) {
        e.preventDefault();
        let formData = $('#formAtendimento').serialize();
        url = "{{ route('atendimento.store') }}";
        type = 'POST';
        sendData(url, type, formData);
    });

    $('#btn-submit-edit').click(function(e) {
        e.preventDefault();
        let formData = $('#formAtendimento').serialize();
        let id = $('#idAtendimento').val();
        let urlUpdate = "{{ route('atendimento.update', ':id') }}";
        let url = urlUpdate.replace(':id', id);
        let type = 'PUT';
        sendData(url, type, formData);
    });

    $('#btn-delete').click(function(e) {
        e.preventDefault();
        let id = $('#idAtendimento').val();
        let urlDelete = "{{ route('atendimento.destroy', ':id') }}";
        let url = urlDelete.replace(':id', id);
        let type = 'POST';
        let data = {
            _token: "{{ csrf_token() }}",
            _method: "DELETE",
            id: id,
        }
        console.log(url);

        sendData(url, type, data);
    });


    function sendData(url, type, data = '') {
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response) {
                if (response.msg_type === 'success') {
                    limpaForm();
                    listData();
                    carregaCards();
                    toastr.success(response.msg);
                }
            },
            error: function(xhr, status, error) {
                toastr.error(response.msg);
            }
        });
    }

    function limpaForm() {
        $('#formAtendimento')[0].reset();
        $('#idAtendimento').remove();
        $('#button-container').show();
        $('#edit-button-container').hide();
        $('#delete-button-container').hide();
    }

    function desmarcaCheckbox() {
        $('input[type="checkbox"]').click(function() {
            $('#idAtendimento').remove();
            $('input[type="checkbox"]').not(this).prop('checked', false);
            if ($('input[type="checkbox"]:checked').length === 0) {
                limpaForm();
            }
        });
    }

    function carregaCards() {

        $.ajax({
            url: "{{ route('atendimento.card') }}",
            type: "GET",
            success: function(response) {
                if (response.msg_type === 'success') {
                    $('#diario-card').text(response.diario);
                    $('#semanal-card').text(response.semanal);
                    $('#mensal-card').text(response.mensal);
                }
            }
        });

    }
</script>
