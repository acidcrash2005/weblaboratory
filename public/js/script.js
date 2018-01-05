$(function(){

    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    } //add a suffix


    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;

    })

});


$(document).ready(function(){


    tinymce.init({
        menubar: false,
        selector:'textarea',
        skin: 'voyager',
        plugins: 'link, codesample, lists, spellchecker, youtube code',
        height : 200,
        extended_valid_elements : 'input[onclick|value|style|type]',
        toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image youtube giphy | code codesample | spellchecker',
        convert_urls: false,
        image_caption: true,
        image_title: true,
        browser_spellcheck:true,
        spellchecker_language: 'ru_RU'
    });

});