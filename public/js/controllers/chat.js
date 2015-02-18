
App.IndexController = Ember.ArrayController.extend({

    "command" : null,

    "actions" : {

        "send" : function(key) {

            if (key && key != 13) {
                return;
            } 
            
            var command = this.get("command") || "";

            if (command.indexOf("@chname") === 0) {

                socket.send(JSON.stringify({
                    "type" : "name",
                    "data" : command.split("@chname")[1]
                }));

            } else {

                socket.send(JSON.stringify({
                    "type" : "message",
                    "data" : command
                }));

            }

            this.set("command", null);
        },
        "init" : function(username) {
            socket.send(JSON.stringify({
                "type" : "name",
                "data" : username
            }));            
        }

    }

});

App.CusersController = Ember.ArrayController.extend({
    "command" : null,
    "actions" : {
        "send" : function(key) {
            var command = this.get("command") || "";
            this.set("command", null);
        },
        "init" : function(username) {
        }

    }

});
