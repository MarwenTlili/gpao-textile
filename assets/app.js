/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

const $ = require('jquery');

require('bootstrap');
require('bootstrap-icons/font/bootstrap-icons.css');

// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';

// start the Stimulus application
// import './bootstrap';

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

// require('./javascript/main.js');

$(function() {
    /**
     * get userId from twig
     */
    // var jsUserId = document.querySelector('.js-user-id');
    // var userId = jsUserId.dataset.userId;
    // console.log('userId: '.userId);

    // or with jQuery
    let userId = $('.js-user').data('user');
    /**
     * callback data from mercure
     */
    if (userId) {
        const url = new URL('https://localhost/.well-known/mercure');

        let of_lancer = 'http://issatex.com/of/lancer/'+userId;
        let of_larguer = 'http://issatex.com/of/larguer/'+userId;

        url.searchParams.append('topic', of_lancer);
        url.searchParams.append('topic', of_larguer);

        // The URL class is a convenient way to generate URLs such as https://localhost/.well-known/mercure?topic=https://example.com/books/{id}&topic=https://example.com/users/dunglas
        const eventSource = new EventSource(url);
        // const eventSource = new EventSource("{{ mercure(['"+of_lancer+"','"+of_larguer+"'])|escape('js') }}");

        // The callback will be called every time an update is published
        eventSource.onmessage = event => {
            var data = JSON.parse(event.data).ordre_fabrication;
            // console.log(data);
            let id = data.id;
            let lancer = data.lancer;
           
            if (lancer) {
                $("#of_"+id+"_update_delete_btns").hide(function(){
                    // $("notifMenuButton").addClass('btn-danger');
                    $(this).removeClass('d-inline')
                    $("#no-notif").remove();

                    $("#of-notifications-menu").append("\
                        <a type='button' data-bs-toggle='modal' data-bs-target='#OfNotificationModal' class='d-flex justify-content-center' \
                            data-id='"+id+"'>\
                            OF " + id + " lancer\
                        </a>\
                    ");
                    
                });
                $('.bi-bell-fill').css({
                    color: "red"
                })
            }else{
                $("#of_"+id+"_update_delete_btns").addClass('d-inline')
                $("#of_"+id+"_update_delete_btns").show(function(){
                    
                });
            }
        }
    }

    var exampleModal = document.getElementById('OfNotificationModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
      
        var modalTitle = exampleModal.querySelector('.modal-title')
        modalTitle.textContent = 'Ordre Fabrication ' + id
        
        $.ajax({
            method: "GET",
            url: "/ordre-fabrication/"+id,
            // data: {id: id},
            success: function(reponse){
                // console.log(reponse)
                exampleModal.querySelector('.modal-body .createdAt').textContent = new Date(reponse.createdAt).toLocaleString('fr-FR')
                exampleModal.querySelector('.modal-body .date_lancement').textContent = new Date(reponse.date_lancement).toLocaleString('fr-FR')
                exampleModal.querySelector('.modal-body .client').textContent = reponse.client
                exampleModal.querySelector('.modal-body .article').textContent = reponse.article
                exampleModal.querySelector('.modal-body .qteTotal').textContent = reponse.qteTotal
                exampleModal.querySelector('.modal-body .montant').textContent = reponse.montant + ' TND'
                exampleModal.querySelector('.modal-body .urgent').textContent = reponse.urgent
                exampleModal.querySelector('.modal-body .lancer').textContent = reponse.lancer
                if (reponse.ordreFabricationTailles[0]) {
                    exampleModal.querySelector('.modal-body .ordreFabricationTailles .L').textContent = reponse.ordreFabricationTailles[0].L
                }
                if (reponse.ordreFabricationTailles[1]) {
                    exampleModal.querySelector('.modal-body .ordreFabricationTailles .M').textContent = reponse.ordreFabricationTailles[1].M
                }
                if (reponse.ordreFabricationTailles[2]) {
                    exampleModal.querySelector('.modal-body .ordreFabricationTailles .XL').textContent = reponse.ordreFabricationTailles[2].XL
                }
            }
        });
    })

    /**
     * article toggle
     */
    $( "#ordre_fabrication_nouveauArticle" ).on('click', function() {
        $( "#article_new" ).toggle(function() {
            
        });
        $("#article_select").toggle(function(){
            
        })
    });
});
