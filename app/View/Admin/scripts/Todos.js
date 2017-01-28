/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var TodoListController = (function () {
        function TodoListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.results = [];
            this.compile = function (data) {
                _this.$scope.data.todos = [];
                angular.forEach(data, function (v, k) {
                    _this.$scope.data.todos.push({ name: k, items: v });
                });
            };
            this.update = function (item) {
                item.ident = item.ident || item.name.replace(/\W+/g, '-').toLowerCase();
                if (item.status === 'incomplete' && _this.findItem(item)) {
                    item.status = item.force = 'complete';
                }
            };
            this.unmark = function (item) {
                var match = _this.findItem(item);
                if (match) {
                    match.remove().then(function () {
                        delete (item.force);
                        item.status = 'incomplete';
                    });
                }
            };
            this.findItem = function (item) {
                return window['_'].find(_this.$scope.statuses, { ident: item.ident });
            };
            this.mark = function (item) {
                _this.$scope.statuses.create().attr('ident', item.ident).save('Item updated').then(function () {
                    item.status = item.force = 'complete';
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {
                states: [{ label: 'All', state: null }, { label: this.gettext('Incomplete'), state: 'incomplete' }, { label: this.gettext('Completed'), state: 'complete' }],
                currentState: null
            };
        }
        return TodoListController;
    }());
    Admin.TodoListController = TodoListController;
    angular.module('todoListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('todoListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TodoListController]);
})(Admin || (Admin = {}));
