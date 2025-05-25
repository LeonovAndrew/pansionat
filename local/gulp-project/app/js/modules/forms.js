// function showSucess(data, _self, jsMetrika) {
//     $(_self).nextAll('.error').fadeOut();
//
//     if (data.msg == 'ok') {
//         if (
//             jsMetrika && jsMetrika != 'undefined' && jsMetrika != '' && jsMetrika != undefined &&
//             window.metrikaID && window.metrikaID != 'undefined' && window.metrikaID != '' &&
//             window.metrikaID != undefined
//         ) {
//             ym(window.metrikaID, 'reachGoal', jsMetrika);
//
//             console.log('ym');
//             console.log(ym);
//             console.log('ym');
//         }
//
//         $(_self).fadeOut(function () {
//             $(_self).next('.add-review-form__succes').fadeIn();
//             $(_self).next('.success').fadeIn();
//         })
//     } else {
//         $(_self).nextAll('.error').html(data.error).fadeIn();
//         _self.find('button').removeAttr('disabled');
//     }
// }
//
//
// function progressHandlingFunction(e) {
//     if (e.lengthComputable) {
//         $('progress').attr({value: e.loaded, max: e.total});
//     }
// }
//
// document.addEventListener('DOMContentLoaded', function () {
//     // ym(window.metrikaID, 'getClientID', function (clientID) {
//     //     $('form').find('input[name=client_ids]').val(clientID)
//     // });
// })
//
// document.addEventListener('DOMContentLoaded', function () {
//     // requirejs(["jquery", 'inputmask'], function ($,i) {
//         var timeout = 5000;
//         var url = '/local/ajax/process.php'
//         var error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
//         var error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';
//
//
//         $('body').on('submit', '.js-form', function (e) {
//             e.preventDefault();
//             var formData = new FormData($(this)[0]);
//             var _self = $(this);
//             var hasErrors = false;
//             var inputs = _self.find('input[data-req=true]');
//             var jsMetrika = $(this).attr('data-metrika');
//
//             console.log(jsMetrika);
//
//             if (inputs.length > 0) {
//                 inputs.each(function (idx, item) {
//                     if ($(item).val() == '') {
//                         $(item).addClass('error');
//                         hasErrors = true;
//                     }
//                 });
//             }
//
//             if (!hasErrors) {
//                 _self.find('button').attr('disabled', 'disabled');
//                 $.ajax({
//                     url: url,  //Server script to process data
//                     type: 'POST',
//                     xhr: function () {  // Custom XMLHttpRequest
//                         var myXhr = $.ajaxSettings.xhr();
//                         if (myXhr.upload) { // Check if upload property exists
//                             myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
//                         }
//                         return myXhr;
//                     },
//                     error: function (request, error) {
//                         _self.find('button').removeAttr('disabled');
//                         if (error == "timeout") {
//                             alert(error_timeout);
//                         } else {
//                             alert(error_default);
//                         }
//                     },
//                     success: function (data) {
//                         console.log(data);
//                         showSucess(data, _self, jsMetrika)
//                     },
//                     data: formData,
//                     cache: false,
//                     contentType: false,
//                     processData: false,
//                     timeout: timeout,
//                     dataType: 'json'
//                 });
//
//             }
//             return false;
//         });
//
//         $('body').on('focus', 'input.error', function () {
//             $(this).removeClass('error');
//         });
//
//         $('body').on('change', 'input.error', function () {
//             $(this).removeClass('error');
//         });
//     // })
// })
