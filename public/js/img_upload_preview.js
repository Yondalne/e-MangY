profilImg.onchange = evt => {
    const [file] = profilImg.files
    if (file) {
        profil.src = URL.createObjectURL(file)
    }
}

bgImg.onchange = evt => {
    const [file] = bgImg.files
    if (file) {
        bg.src = URL.createObjectURL(file)
    }
}

// $(".popUp").hide()
// var cropper,reader,file;

// function getRoundedCanvas(sourceCanvas) {
//     var canvas = document.createElement('canvas'); // creation de canvas
//     var context = canvas.getContext('2d'); // prendre une canvas en deux dimensions
//     var width = sourceCanvas.width; //  recuperation des dimensions
//     var height = sourceCanvas.height;//


//     // dessination  du  canvas
//     canvas.width = width;
//     canvas.height = height;
//     // attribution des dimensions au canvas
//     context.imageSmoothingEnabled = true;  // permettre un pixelisation parfaite des  images
//     context.drawImage(sourceCanvas, 0, 0, width, height); // dessiner une image
//     context.globalCompositeOperation = 'destination-in'; //
//     context.beginPath();
//     context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
//     // remplir avec tout les traces
//     context.fill();
//     return canvas;
// }

// $('body').on('change', function (e) {
//     var image = document.getElementById('uploadImg');
//     var button = document.getElementById('crop');
//     // var result = document.getElementById('result');
//     var croppable = false;

//     var files = e.target.files;
//     var done = function(url) {
//         image.src = url;
//         $(".popUp").show();
//     };

//     if (files && files.length > 0) {
//         file = files[0];

//         if (URL) {
//             done(URL.createObjectURL(file));
//         } else if (FileReader) {
//             reader = new FileReader();
//             reader.onload = function(e) {
//                 done(reader.result);
//             };
//             reader.readAsDataURL(file);
//         }
//     }

//     // console.log(imgProfil.action)

//     var cropper = new Cropper(image, {
//         aspectRatio: 1,
//         viewMode: 3,
//         preview: '.preview',
//         ready: function () {
//             croppable = true;
//         },
//     });

//     button.onclick = function () {
//         var croppedCanvas;
//         var roundedCanvas;
//         var action = imgProfil.action;
//         // var roundedImage;

//         if (!croppable) {
//             return;
//         }

//         // Crop
//         croppedCanvas = cropper.getCroppedCanvas();

//         // Round
//         roundedCanvas = getRoundedCanvas(croppedCanvas);
//         console.log(roundedCanvas);

//         roundedCanvas.toBlob(function(blob) {       // Cree un objet qui represente l'image contenue dans le canvas
//             url = URL.createObjectURL(blob);        // Cree une url pour le blob
//             var reader = new FileReader();
//             console.log(blob)
//             reader.readAsDataURL(blob);             // transforme le blob en format base64 qui est une chaine de caractere
//             reader.onloadend = function() {         // Une fois que la ecture est termine tu execute le code en dessous
//                 var base64data = reader.result;     // recupere le l'image transformee en chaine de caractere

//                 $.ajaxSetup({
//                     headers: {
//                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')      // envoie de csrf token (sans ca laravel refuse l'envoie de donnee)
//                     }
//                 });

//                 $.ajax({
//                     type: "PATCH",
//                     dataType: "json",
//                     url: action,
//                     data: {image: base64data},
//                     success: function(response) {
//                         console.log(response)
//                     }
//                 });
//             };
//             // var formData = new FormData();
//             // formData.append('avatar', blob);

//             // Use `jQuery.ajax` method

//             // $.ajaxSetup({
//             //     headers: {
//             //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             //     }
//             // });
//             // $.ajax(action, {
//             //     method: "PATCH",
//             //     data: formData,
//             //     processData: false,
//             //     contentType: false,
//             //     success: function (response) {
//             //         console.log(response);
//             //     },
//             //     error: function () {
//             //         console.log('Upload error');
//             //     }
//             // });

//         });


//         // Show
//         // roundedImage = document.createElement('img');
//         // roundedImage.src = roundedCanvas.toDataURL()
//         // result.innerHTML = '';
//         // result.appendChild(roundedImage);
//     };
// });
