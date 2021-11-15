function iziToastExcluir(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Exclusão: ',
        message: 'Deseja realmente excluir?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                excluir(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}


function iziToastExcluir2(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Exclusão: ',
        message: 'Deseja realmente excluir?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                excluir2(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}

function iziToastDesativar(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Desativar: ',
        message: 'Deseja realmente desativar?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                desativar(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}

function iziToastRejeitar(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Rejeitar: ',
        message: 'Deseja realmente rejeitar a proposta?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                rejeitar(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}

function iziToastAceitar(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Aceitar: ',
        message: 'Deseja realmente aceitar a proposta? Isto rejeitará todas as outras',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                aceitar(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}