/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
define([
    'jquery',
    'uiComponent'
], function ($, Component) {
    'use strict';

    return Component.extend({
        initialize: function () {

            $(document).ready(function() {
                $.ajax({
                    type: 'GET',
                    url: window.location.origin + '/wdevs/topbar/getconfig?isAjax=1',
                    success: function (data) {
                        if (data.status == 'success') {
                            if (data.enable == 1) {
                                $('.wdevs-top-bar').html(data.content);
                                $('.wdevs-top-bar').show();
                            }  
                        }
                    }
                });
            });
        }
    });
});