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

function iziToastBanir(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Banimento: ',
        message: 'Deseja realmente Banir o Usuário?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                banir(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}

function iziToastReativar(id){
    iziToast.show({
        timeout: 20000,
        icon: 'fa fa-trash-o',
        close: false,
        overlay: true,
        displayMode: 'once',
        color: 'dark',
        id: 'question',
        zindex: 999,
        title: 'Reativação: ',
        message: 'Reativar o Usuário?',
        position: 'center',
        buttons: [
            ['<button><b>SIM</b></button>', function (instance, toast) {

                reativar(id);
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
            ['<button>NÃO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }, true],
        ]
    });
}
