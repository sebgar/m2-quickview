define([
    'jquery',
    'mage/translate',
    'Magento_Ui/js/modal/modal',
], function ($, $t, modal) {
    'use strict';

    $.widget('mage.quickview', {
        modalWindow: null,

        _create: function () {
            this.initButtons();
            this.createPopup(this.options.elements.modal);
        },

        initButtons: function () {
            var self = this;

            // add buttons inside all container
            if (this.options.append_buttons.enable) {
                $(this.options.append_buttons.container).each(function (index, element) {
                    var idProductElement = $(element).find(this.options.append_buttons.id_product.selector);
                    if (idProductElement.length) {
                        // search id product
                        var idProduct = idProductElement.data(this.options.append_buttons.id_product.data);

                        // prepare html
                        var html = this.options.append_buttons.html;
                        html = html.replace(/\{id\}/, idProduct);

                        // add html
                        $(element).append(html);
                    }
                }.bind(this));
            }

            // bind click
            $(document).on('click', this.options.elements.button, function (event) {
                event.preventDefault();

                self.processQuickView($(event.currentTarget).data('product-id'));
            });
        },

        processQuickView: function (productId) {
            var self = this,
                url = this.options.url + 'id/' + productId + '?quickview=1';

            $('body').loader('show');

            $.ajax({
                type: 'GET',
                url: url,
                cache: false,
                success: function (response) {
                    if (response.html) {
                        $(self.options.elements.modal).html(response.html);
                        self.showModal();
                    }

                    $('body').loader('hide');
                }
            });
        },

        createPopup: function (element) {
            this.modalWindow = element;
            modal(this.options.popup_options, $(this.modalWindow));
        },

        showModal: function () {
            $(this.modalWindow).modal('openModal').trigger('contentUpdated');
        }
    });

    return $.mage.quickview;
});

