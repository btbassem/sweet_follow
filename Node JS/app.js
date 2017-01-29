// variable du serveur NodeJS
var express = require('express'),
	app=express(),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server);
var mysql = require('mysql');

// variable globale
var connection = mysql.createConnection({
	host : 'localhost', 
	user : 'root', 
	password : 'root', 
	database : 'sweet_follow',
});
connection.connect(function(err){
if(!err) {
    console.log("Database is connected ... ");    
} else {
    console.log("Error connecting database ... ");    
}
});

app.use(express.static('public'));
server.listen(3000);
/*
app.get('/', function(req, res){
	res.sendfile(__dirname+ '/messages1.html');
});
*/
io.sockets.on('connection', function(socket){
	

	// recevoir stoker et partager le nouveau message
	socket.on('send message', function(data){
		try {

			req = 'INSERT INTO `message`(`id_message`, `expediteur_message`, `recepteur_message`, `date_message`, `contenu_message`) VALUES ('+
				"NULL,"+
				"'"+data.user1+"',"+
				"'"+data.user2+"',"+
				'CURRENT_TIMESTAMP'+","+
				"'"+data.msg+"'"+
				');';
			// insertion du message dans la base de données
			connection.query(req, function(error) {
	    	    if (error) {
	    	        console.log(error.message+'\n**'+req);
	    	    } else {
	    	        // afficher les informations de l'utilisateur
	    	        req = 'SELECT `prenom_utilisateur`,`photo_entite` FROM `entite`,`utilisateur` WHERE `utilisateur`.`entite_utilisateur` = `entite`.`id_entite` AND `utilisateur`.`email_utilisateur` = '+"'"+data.user1+"'";

					connection.query(req, function(err, rows, fields) {
					    if (err) throw err;
					    rows[0].prenom_utilisateur
					    rows[0].photo_entite
					    io.sockets.emit('new message', {msg: data.msg, 'user1':data.user1, 'user2':data.user2, 'prenom_utilisateur':rows[0].prenom_utilisateur, 'photo_entite':rows[0].photo_entite}); 
					}); 
	    	    }
	    	});
	    	console.log(data.user1+' send message to '+data.user2);

	    } catch (err) {
		    // handle the error safely
		    console.log(err)
		}
	});

	// recevoir et envoyer nombre de nouvelle notification
	socket.on('get notification', function(data){
		try {
			// afficher les informations de l'utilisateur
	        req = 
	        "SELECT  "+
			"	* "+
			"FROM  "+
			"	`notification`, "+
			"    `entite`, "+
			"    `utilisateur` "+
			"WHERE "+
			"	`notification`.`acteur_notification` = `utilisateur`.`email_utilisateur` AND "+
			"    `utilisateur`.`entite_utilisateur` = `entite`.`id_entite` AND "+
			"	((`notification`.`id_notification_notification` "+
			"    IN ("+
			"        SELECT 	`id_notification_notification` "+
			"        FROM `notification`,`publication`,`entite`,`utilisateur` "+
			"        WHERE 	"+
			"        	`notification`.`id_publication_notification` = `publication`.`id_publication` AND     "+
			"        	`entite`.`id_entite` = `publication`.`admin_publication` AND     "+
			"        	`entite`.`id_entite` = `utilisateur`.`entite_utilisateur` AND "+
			"        	`utilisateur`.`email_utilisateur` = '"+data.user+"')) OR "+
			"	notification.id_publication_notification  = '"+data.user+"')"+
			" ORDER BY notification.date_notification DESC";

			connection.query(req, function(err, rows, fields) {
			    if (err) {
			    	console.log(err);
			    }else{
				    io.sockets.emit('notification', {'row': rows, 'user':data.user});
			    } 
			});
			console.log('notification is sended for user : '+data.user);

		} catch (err) {
		    console.log(err);
		}
	});

});