

App.IndexView = Ember.View.extend({

    "keyDown" : function(e) {
        this.get("controller").send("send", e.keyCode, 1);
    }

});

try {

    var id = 1;

    if (!WebSocket) {

        console.log("no websocket support");

    } else {

        var socket = new WebSocket("ws://127.0.0.1:8080/");
        var id     = 1;

        socket.addEventListener("open", function (e) {
//            console.log("open: ", e);
//            console.log("initialusernicname: ", $('#initialusernicname').text());
//            var data = JSON.parse(e.data);
//            console.log("data: ", data);
//            $(".name-" + data.user.id).html($('#initialusernicname').text());
////            App.get("controller").send("init", $('#initialusernicname').text());
        });

        socket.addEventListener("error", function (e) {
            console.log("error: ", e);
        });

        socket.addEventListener("message", function (e) {

            var data = JSON.parse(e.data);

            switch (data.message.type) {

                case "name":

                    $(".name-" + data.user.id).html(data.user.name);

                    break;

                case "message":
                    defaultName = 'Anonimous';//(data.message.isCurrentUser === 'yes')?$('#initialusernicname').text():'Anonimous';
                    store.push("message", {
                        "id"            : id++,
                        "user_id"       : data.user.id,
                        "user_name"     : data.user.name || defaultName,
                        "user_id_class" : "name-" + data.user.id,
                        "message"       : data.message.data
                    });

                    break;

            }

        });

        console.log("socket:", socket);

        window.socket = socket; // debug

    }

} catch (e) {

    console.log("exception: " + e);

}