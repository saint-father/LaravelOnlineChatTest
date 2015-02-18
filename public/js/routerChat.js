// create a new Ember application
var App = Ember.Application.create();

// tell the application to equate the path / to the index resource
App.Router.map(function() {
    this.resource("index", { "path" : "/" });
    //this.resource("cusers", { "path" : "cusers" });
});

var store;

App.CusersRoute = Ember.Route.extend({
    "init" : function() {
//        store = this.store;
    },
    "model" : function () { 
//        return store.find("message");
    }
});

App.IndexRoute = Ember.Route.extend({
    "init" : function() {
        store = this.store;
    },
    "model" : function () { 
        return store.find("message");
    }
});

