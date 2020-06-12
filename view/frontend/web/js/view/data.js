define([
    'ko',
    'uiComponent',
], function (ko, Component) {
    'use strict';

    return Component.extend({
        additionalText: ko.observable('Click a row, button, or list item to show additional text here.'),
        defaults: {
            template: 'ChrisMallory_CodeSample/index',
        },
        initialize: function () {
            self = this;
            this._super();
        },
        getAdditionalText: function (data,event) {
            self.additionalText(data.additional_text);
        }
    });
});