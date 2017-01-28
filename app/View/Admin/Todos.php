<div class="content-wrapper ng-cloak" ng-app="todoListApp" ng-controller="todoListController as mainCtrl">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">List of todos</span></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-todo"></i> <span translate="">Todo list</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.todo.admin" as="mainCtrl.data.panels" on-change="mainCtrl.compile(data)"></minute-event>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><span translate="">All todo items</span></h3>

                    <div class="box-tools">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default" ng-repeat="state in data.states" ng-click="data.currentState = state.state"
                                    ng-class="{active: state.state === data.currentState}">
                                <span translate="">{{state.label}}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="box-body" ng-repeat="panel in data.todos | orderBy:'name'">
                    <h4>
                        <a class="text-muted" href="" ng-click="collapsed[panel.name] = true" ng-show="!collapsed[panel.name]"><i class="fa fa-minus-square-o"></i></a>
                        <a class="text-muted" href="" ng-click="collapsed[panel.name] = false" ng-show="!!collapsed[panel.name]"><i class="fa fa-plus-square-o"></i></a>
                        {{panel.name | ucfirst}} <span translate="">todo list</span>
                    </h4>

                    <div class="list-group" ng-show="!collapsed[panel.name]">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{item.status == 'complete' && 'success' || 'danger'}}" ng-repeat="item in panel.items"
                             ng-if="!status || item.status === status" ng-init="mainCtrl.update(item)" ng-show="!data.currentState || (item.status === data.currentState)">
                            <div class="pull-left">
                                <p class="list-group-item-heading">
                                    <i class="fa fa-fw {{item.status == 'complete' && 'fa-check-square-o' || 'fa-square-o'}}"></i>
                                    <a href="" ng-href="{{item.link}}">{{item.name}}</a>
                                </p>
                                <p class="list-group-item-text hidden-xs text-muted" ng-show="item.description"><i class="fa fa-fw"></i> {{item.description}}</p>
                            </div>

                            <div class="md-actions pull-right">
                                <div class="badge inline-block" ng-if="item.status === 'complete'">
                                    <div class="dropdown inline-block">
                                        <div class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                            {{!item.manual && item.force && 'ignored' || item.status}}
                                            <span class="caret" ng-if="!!item.manual || !!item.force"></span>
                                        </div>
                                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1" ng-if="!!item.manual || !!item.force">
                                            <li><a href="" class="text-small" ng-click="mainCtrl.unmark(item)">Reset this task</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="badge inline-block" ng-if="!item.manual && item.status !== 'complete'">
                                    <div class="dropdown inline-block">
                                        <div class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">{{item.status}} <span class="caret"></span></div>
                                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="" class="text-small" ng-click="mainCtrl.mark(item)">Ignore this task</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="pull-right" ng-if="item.manual && item.status == 'incomplete'">
                                    <button type="button" class="btn btn-xs btn-default" ng-click="mainCtrl.mark(item)"><i class="fa fa-check-circle"></i> Mark as completed</button>
                                </span>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
