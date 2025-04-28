<?php

namespace App\Libraries;
use MongoDB\Driver\ServerApi;

class MongoDBLibrary
{
    private $username;
    private $password;
    private $clusterName;
    private $client;

    public function __construct()
    {
        $this->username = getenv('mongodb.default.username');
        $this->password = getenv('mongodb.default.password');
        $this->clusterName = getenv('mongodb.default.cluster');

        $formattedClusterName = ucfirst($this->clusterName);

        $uri = "mongodb+srv://{$this->username}:{$this->password}@{$this->clusterName}.6xziozw.mongodb.net/?appName={$formattedClusterName}";
        $apiVersion = new ServerApi(ServerApi::V1);

        $this->client = new \MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

    }

    public function pingDB() {
        
        $result =  $this->client->selectDatabase('admin')->command(['ping' => 1]);
        return $result->toArray()[0]->ok == 1 ? true : false;

    }

    public function getClient() {
        return $this->client;
    }

    #------- For single operations -------#

    public function createDocument($database, $collection, $document) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->insertOne($document);

    }

    public function findDocument($database, $collection, $filter) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->findOne($filter);

    }

    public function updateDocument($database, $collection, $filter, $update) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->updateOne($filter, ['$set' => $update]);

    }

    public function deleteDocument($database, $collection, $filter) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->deleteOne($filter);

    }

    #------- End of single operations -------#

    #------- For multiple operations -------#

    public function createDocuments($database, $collection, $documents) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->insertMany($documents);

    }

    public function findDocuments($database, $collection, $filter) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return iterator_to_array($collection->find($filter));

    }

    public function updateDocuments($database, $collection, $filter, $update) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->updateMany($filter, ['$set' => $update]);

    }

    public function deleteDocuments($database, $collection, $filter) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->deleteMany($filter);

    }

    public function getallDocuments($database, $collection) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return iterator_to_array($collection->find([]));

    }

    public function countDocuments($database, $collection) {

        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
        return $collection->countDocuments([]);

    }
    
    #------- End of multiple operations -------#

    public function listCollections($database) {

        $db = $this->client->selectDatabase($database);
        return $db->listCollections();

    }

    #------- Start of specific operations -------#
    
    public function getSpecificDetailInDocument($database, $collection, $filter, $field)
    {
        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
    
        // Use projection to retrieve only the specified field
        $projection = [$field => 1, '_id' => 0]; // Include the field, exclude the _id field
        $document = $collection->findOne($filter, ['projection' => $projection]);
    
        // Return the specific field value if the document exists
        return $document ? $document[$field] : null;
    }

    public function getSpecificDetailInDocuments($database, $collection, $filter, $field)
    {
        $db = $this->client->selectDatabase($database);
        $collection = $db->selectCollection($collection);
    
        // Use projection to retrieve only the specified field
        $projection = [$field => 1, '_id' => 0]; // Include the field, exclude the _id field
        $documents = $collection->find($filter, ['projection' => $projection]);
    
        // Return an array of specific field values
        return iterator_to_array($documents);
    }


}

?>