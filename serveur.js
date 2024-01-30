const express = require('express');
const net = require('net');
const cors = require('cors');
const app = express();
const httpServer = require('http').createServer(app);

// Utilisation du middleware CORS pour permettre les requêtes cross-origin
app.use(cors());

// Middleware pour parser le corps JSON des requêtes entrantes
app.use(express.json());

// Variable pour stocker la socket TCP de l'HoloLens
let hololensSocket = null;

// Création du serveur TCP pour écouter les connexions de l'HoloLens
const tcpServer = net.createServer((socket) => {
    console.log('HoloLens connecté via TCP.');

    // Stockage de la socket TCP pour une utilisation ultérieure
    hololensSocket = socket;

    socket.on('data', (data) => {
        console.log('Données reçues de l\'HoloLens: ' + data);
        // Traitez les données ici si nécessaire
    });

    socket.on('close', () => {
        console.log('HoloLens déconnecté.');
        hololensSocket = null;
    });

    socket.on('error', (err) => {
        console.error('Erreur de socket TCP:', err);
    });
});

tcpServer.listen(8000, () => {
    console.log('Serveur TCP écoutant sur le port 8000 pour l\'HoloLens.');
});

// API pour recevoir des données du site web et les envoyer à l'HoloLens
app.post('/send-to-hololens', (req, res) => {
    if (hololensSocket && !hololensSocket.destroyed) {
        hololensSocket.write(JSON.stringify(req.body));
        res.json({ status: 'success', message: 'Données envoyées à l\'HoloLens.' });
    } else {
        res.status(500).json({ status: 'error', message: 'Aucune connexion active de l\'HoloLens.' });
    }
});

// Démarrage du serveur HTTP pour les requêtes du site web
httpServer.listen(3000, () => {
    console.log('Serveur HTTP écoutant sur le port 3000 pour les requêtes du site web.');
});
