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
        title: 'Exclusão: ',
        message: 'Deseja realmente Banir o cliente?',
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
