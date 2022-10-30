document.addEventListener("DOMContentLoaded", function() {
    // instanciate new modal
    var modal = new tingle.modal({
        footer: false,
        stickyFooter: false,
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Close",
        cssClass: ['dolyame-widget__modal']
    });

    modal.setContent(document.querySelector('.js-dolyame-widget-content').innerHTML);
    document.querySelector('.js-dolyame-widget-popup-button').addEventListener('click', function (){
        modal.open();
    });
    document.querySelector('.js-dolyame-widget-popup-close').addEventListener('click', function (){
        modal.close();
    })
});