$(document).ready(function () {
    $(".cep-input").mask("99999-999");
    $(".cpf-input").mask("999-999-999.99");
    $(".celular-input").mask("(99)99999-9999");
});

function formataCPF(cpf) {
    if (cpf != null) {
        cpf = cpf.toString().replace(/\D/g, '');
        if (cpf.length <= 3) return cpf;
        if (cpf.length <= 6) return cpf.replace(/(\d{3})(\d{1,3})/, '$1.$2');
        if (cpf.length <= 9) return cpf.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
        return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
    }

}

function formataContato(phone) {
    if (phone != null) {
        phone = phone.toString().replace(/\D/g, '');
        if (phone.length <= 2) return phone;
        if (phone.length <= 6) return phone.replace(/(\d{2})(\d{1,5})/, '($1) $2');
        if (phone.length <= 10) return phone.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
        return phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }
}

function formataCEP(cep) {
    cep = cep.toString().replace(/\D/g, '');
    return cep.replace(/(\d{5})(\d{3})/, '$1-$2');
}
