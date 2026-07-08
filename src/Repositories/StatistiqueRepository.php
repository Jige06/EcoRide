<?php

class StatistiqueRepository
{
    private $collection;

    public function __construct()
    {
        $database = MongoDatabase::getInstance()->getDatabase();
        $this->collection = $database->selectCollection('inscriptions');
    }

    // Enregistre un évènement "inscription" avec sa date, pour alimenter
    // le futur graphique de l'espace administrateur
    public function enregistrerInscription()
    {
        $this->collection->insertOne([
            'type' => 'inscription',
            'date' => date('Y-m-d'),
            'horodatage' => new \MongoDB\BSON\UTCDateTime(),
        ]);
    }
}