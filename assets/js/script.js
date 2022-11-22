const notyf = new Notyf({
    dismissible: true,
    duration: 2000,
    position: {
        x: 'right',
        y: 'top',
    },
    types: [{
        type: 'warning',
        background: '#fb8500'
    }, {
        type: 'info',
        background: '#219ebc'
    }, {
        type: 'error',
        background: '#e63946'
    }, {
        type: 'success',
        background: '#80b918'
    }]
});