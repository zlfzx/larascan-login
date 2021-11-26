<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Login with QRCode') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4">
        <video id="video" style="width: 100%; height: 380px;" autoplay></video>
    </div>

    <x-slot name="script">
        <script>
            // check
            if (!('BarcodeDetector' in window)) {
                console.warn('Browser tidak support BarcodeDetecor')
            }


            // video element
            const video = document.querySelector('#video')
            // check if device has camera
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // use video without audio
                const constraints = {
                    video: {
                        facingMode: 'environment'
                    },
                    audio: false
                }

                // start video stream
                navigator.mediaDevices.getUserMedia(constraints).then(stream => video.srcObject = stream)
            }

            // create new BarcodeDetector
            const barcodeDetector = new BarcodeDetector({
                format: ['qr_code']
            })

            // detect code function
            const detectCode = () => {
                barcodeDetector.detect(video).then(codes => {
                    if (codes.length === 0) return;

                    // console.log(codes)

                    for (const barcode of codes) {
                        // console.log(barcode.rawValue)

                        let hostname = window.location.hostname
                        let value = barcode.rawValue
                        let url = new URL(value)
                        let search = url.search

                        if (hostname == url.hostname && search.includes('session')) {
                            clearInterval(detect)
                            window.location.href = value
                        }
                    }
                }).catch(err => {
                    console.log(err)
                })
            }

            let detect = setInterval(detectCode, 100);
        </script>
    </x-slot>
</x-app-layout>
