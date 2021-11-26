
Echo.channel('qr-login.' + SESSION_ID).listen('QRLoginEvent', (e) => {
    console.log(e)
    if (e.login) {
        window.location.href = '/dashboard'
    }
})
