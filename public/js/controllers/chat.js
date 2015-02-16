
App.IndexController = Ember.ArrayController.extend({

    "command" : null,

    "actions" : {

        "send" : function(key,isCurrentUser) {

            if (key && key != 13) {
                return;
            } else {
                isCurrentUser = 1;
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
                    "isCurrentUser": (isCurrentUser===1)?'yes':'no',
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
