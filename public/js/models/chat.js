/*
 * This script provides necessary data model 
 * it's built to work on the client-side of the application    
 *    {
 *         "id"   : 1,
 *         "user" : "User1",
 *         "text" : "Hello World."
 *     },
 *     {
 *         "id"   : 2,
 *         "user" : "User2",
 *         "text" : "Nice to meet you"
 *     },
 *     {
 *         "id"   : 3,
 *         "user" : "User1",
 *         "text" : "Nice 2 meet u 2"
 *     }
 *
 */
// define a Message model ()
App.Message = DS.Model.extend({
    "userId"       : DS.attr("number"),
    "userName"     : DS.attr("string"),
    "userIdClass" : DS.attr("string"),
    "message"       : DS.attr("string")
});

App.ApplicationStore = DS.Store.extend({
//    "adapter" : DS.FixtureAdapter.extend()
});

//App.Message.FIXTURES = [
//];

//App.Post = DS.Model.extend({
//  title: DS.attr('string'),
//  body: DS.attr('string')
//});
