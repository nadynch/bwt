<?php

class ConferencesController
{
    private $connector;
    private $connection;

    public function __construct()
    {
        require_once __DIR__ . "/../core/connector.php";
        require_once __DIR__ . "/../model/conference.php";
        $this->connector = new Connector();
        $this->connection = $this->connector->Connection();
    }

    public function run($action)
    {
        switch ($action) {
            case "new":
                $this->new();
                break;
            case "create" :
                $this->create();
                break;
            case "detail" :
                $this->detail();
                break;
            case "edit":
                $this->edit();
                break;
            case "update" :
                $this->update();
                break;
            case "delete":
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index()
    {
        $conference = new Conference($this->connection);
        $data = $conference->getAll();
        $this->view("index", array(
            "conferences" => $data,
            "title" => "All Conferences"
        ));
    }

    public function new()
    {
        $this->view("create",
            "New Conference"
        );
    }

    public function detail()
    {
        $model = new Conference($this->connection);
        $conference = $model->getById($_GET["id"]);
        $this->view("detail", array(
            "conference" => $conference,
            "title" => "Conference Details"
        ));
    }

    public function edit()
    {
        $model = new Conference($this->connection);
        $conference = $model->getById($_GET["id"]);
        $this->view("edit", array(
            "conference" => $conference,
            "title" => "Edit Conference"
        ));
    }

    public function create()
    {
        if (isset($_POST["title"])) {
            $conference = new Conference($this->connection);
            $conference->setTitle($_POST["title"]);
            $conference->setDate($_POST["date"]);
            $conference->setCountry($_POST["country"]);
            $conference->setAddressX($_POST["addressX"]);
            $conference->setAddressY($_POST["addressY"]);
            $save = $conference->save();
        }
        header('Location: index.php');
    }

    public function update()
    {
        if (isset($_POST["id"])) {
            $conference = new Conference($this->connection);
            $conference->setId($_POST["id"]);
            $conference->setTitle($_POST["title"]);
            $conference->setDate($_POST["date"]);
            $conference->setCountry($_POST["country"]);
            $conference->setAddressX($_POST["addressX"]);
            $conference->setAddressY($_POST["addressY"]);
            $save = $conference->update();
        }
        header('Location: index.php');
    }

    public function delete()
    {
        $model = new Conference($this->connection);
        $model->deleteById($_GET["id"]);
        header('Location: index.php');
    }

    public function view($view, $loadData)
    {
        $data = $loadData;
        require_once __DIR__ . "../../view/" . $view . "View.php";
    }
}