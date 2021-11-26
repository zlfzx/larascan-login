<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <video id="video" width="640" height="480" autoplay></video>


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
            navigator.mediaDevices.getUserMedia(constraints).then(stream => video.srcObject= stream)
        }

        // create new BarcodeDetector
        const barcodeDetector = new BarcodeDetector({format: ['qr_code']})

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
</body>
</html>
