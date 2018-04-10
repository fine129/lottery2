jQuery.fn.load = function (callback) {$(window).trigger("load", callback); }
 $(function () {
     var eyeCandy = $('#cropContainerEyecandy');
     var croppedOptions = {
         uploadUrl: 'upload',
         cropUrl: 'crop',
         cropData:{
             'width' : eyeCandy.width(),
             'height': eyeCandy.height()
         }
     };
     var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);

 });
