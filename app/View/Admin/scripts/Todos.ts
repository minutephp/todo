/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class TodoListController {
        private results = [];

        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {
                states: [{label: 'All', state: null}, {label: this.gettext('Incomplete'), state: 'incomplete'}, {label: this.gettext('Completed'), state: 'complete'}],
                currentState: null,
            }
        }

        compile = (data) => {
            this.$scope.data.todos = [];

            angular.forEach(data, (v, k) => {
                this.$scope.data.todos.push({name: k, items: v});
            });
        };

        update = (item) => {
            item.ident = item.ident || item.name.replace(/\W+/g, '-').toLowerCase();

            if (item.status === 'incomplete' && this.findItem(item)) {
                item.status = item.force = 'complete';
            }
        };

        unmark = (item) => {
            let match = this.findItem(item);
            if (match) {
                match.remove().then(()=> {
                    delete(item.force);
                    item.status = 'incomplete';
                });
            }
        };

        findItem = (item) => {
            return window['_'].find(this.$scope.statuses, {ident: item.ident});
        };

        mark = (item) => {
            this.$scope.statuses.create().attr('ident', item.ident).save('Item updated').then(function () {
                item.status = item.force = 'complete';
            });
        };
    }

    angular.module('todoListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('todoListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TodoListController]);
}
