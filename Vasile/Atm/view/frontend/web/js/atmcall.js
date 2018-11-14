define([
    'jquery',
    'underscore',
    'mage/template',
    'jquery/ui'
], function ($, _, mageTemplate) {
    'use strict';
    $.widget('mage.atmcall', {
        options: {
            urlToCall: {},
            appState: {},
        },

        /**
         * Creates widget
         * @private
         */
        _create: function () {

            this._addListner();
        },

        /**
         * add listener to atm withdraw button
         * @private
         */
        _addListner: function(){
            var appThis = this;
            $('#atm_withdraw').on('click', function(e){
                appThis._callAtm();
            });
        },

        /**
         * ajax call for atm witdraw
         * @private
         */
        _callAtm: function(){
            var appThis = this;
            var withdrawAmmount = $('#ammount_atm').val();
            $.ajax({
                url: this.options.urlToCall,
                data: {
                    'ammount':withdrawAmmount,
                },
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    $('#atm_output').text(JSON.stringify(res));
                },
                error: function (res) {

                }
            });
        },
    });
    return $.mage.atmcall;
});