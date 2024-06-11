<?php

abstract class Library
{
    protected $id;
    abstract public function add();
  
}

class Books extends Library
{
    private $name;
    private $bookIsbn;
    private $bookPublisher;
    private $author;


    public function __construct($id = null, $name = null, $bookIsbn = null, $bookPublisher = null, $author = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->bookIsbn = $bookIsbn;
        $this->bookPublisher = $bookPublisher;
        $this->author = $author;
    }

    public function add()
    {

        $bookData = array();

        if (file_exists("book.json")) {
            $dataFromJson = file_get_contents("book.json");
        }

        $bookData = json_decode($dataFromJson, true);

        $bookData[] = [
            "id" => $this->id,
            "book_name" => $this->name,
            "book_publisher" => $this->bookPublisher,
            "book_isbn" => $this->bookIsbn,
            "author" => $this->author
        ];

        $bookData = json_encode($bookData);
        file_put_contents("book.json", $bookData);

        return "success";
    }


    public function delete($id)
    {
        $books = file_get_contents("book.json", true);
        $bookList = json_decode($books, true);

        foreach ($bookList as $key => $book) {
            if ($book['id'] == $id) {
                unset($bookList[$key]);
            }

        }

        $bookList = json_encode($bookList);
        file_put_contents('book.json', $bookList);

        return "successfully deleted with book id " . $id;
    }

    //Similarly write all other required methods
    //Methods could be list, listAscending, listDescending, searchById

    public function list()
    {
        $books = file_get_contents('book.json', true);
        $bookArray = json_decode($books, true);


        foreach ($bookArray as $key => $value) {
            echo "Book Id: " . $value['id'] . "\n";
            echo "Book Name: " . $value['book_name'] . "\n";
            echo "Book ISBN: " . $value['book_isbn'] . "\n";
            echo "Book Publisher: " . $value['book_publisher'] . "\n";
            echo "Book Author: " . $value['author'] . "\n";
            echo "\n";
        }
        echo "\n";

        return "success";
    }

    public function listAscending()
    {

        $books = file_get_contents('book.json', true);
        $bookArray = json_decode($books, true);

        foreach ($bookArray as $key => $value) {
            echo "Book Id: " . $value['id'] . "\n";
            echo "Book Name: " . $value['book_name'] . "\n";
            echo "Book ISBN: " . $value['book_isbn'] . "\n";
            echo "Book Publisher: " . $value['book_publisher'] . "\n";
            echo "Book Author: " . $value['author'] . "\n";

            echo "\n";
        }

        echo "\n";
        return "success";
    }

    public function listDescending()
    {

        $books = file_get_contents('book.json', true);
        $bookArray = json_decode($books, true);

        $bookArrayAfterSort = arsort($bookArray);


        foreach ($bookArray as $key => $value) {
            echo "Book Id: " . $value['id'] . "\n";
            echo "Book Name: " . $value['book_name'] . "\n";
            echo "Book ISBN: " . $value['book_isbn'] . "\n";
            echo "Book Publisher: " . $value['book_publisher'] . "\n";
            echo "Book Author: " . $value['author'] . "\n";

            echo "\n";
        }

        echo "\n";

        return "success";
    }

    public function searchById($id)
    {

        $books = file_get_contents('book.json', true);
        $bookArray = json_decode($books, true);

        foreach ($bookArray as $key => $value) {

            if ($id == $value['id']) {
                echo "Book Id: " . $value['id'] . "\n";
                echo "Book Name: " . $value['book_name'] . "\n";
                echo "Book ISBN: " . $value['book_isbn'] . "\n";
                echo "Book Publisher: " . $value['book_publisher'] . "\n";
                echo "Book Author: " . $value['author'] . "\n";
            }

        }

        echo "\n";
        return "success";
    }

}

class OtherResources
{
    public $id;
    public $name;
    public $description;
    public $res_brand;



    public function add()
    {

        return "success";
    }

    public function delete()
    {

        return "success";
    }

    public function list()
    {

        return "success";
    }


}

// Controller code  

do {
    //Prompt the user for a command
    $userChoice = readline("Enter command (add or delete or list or searchbyid or listDes or listAcs exit )");

    if ($userChoice == 'add') {
        $id = readline("Enter the id of the book \n");
        $name = readline("Enter the name of the book \n");
        $bookIsbn = readline("Enter the isbn number of the book \n");
        $bookPublisher = readline("Enter the publisher of the book \n");
        $author = readline("Enter the author of the book \n");
        $book = new Books($id, $name, $bookIsbn, $bookPublisher, $author);

        $result = $book->add();

        echo "\n" . $result . "\n";

    } elseif ($userChoice == 'delete') {

        $book = new Books();
        $id = readline("Enter the id you want to delete : \n");
        $result = $book->delete($id);

        echo "\n" . $result . "\n";
    } elseif ($userChoice == "list") {
        $book = new Books();
        $result = $book->list();
    } elseif ($userChoice == "searchbyid") {
        $book = new Books();

        $id = readline("Enter the id you want to search : \n");
        $result = $book->searchById($id);
    } elseif ($userChoice == "listDes") {

        $book = new Books();
        $result = $book->listDescending();
    } elseif ($userChoice == "listAcs") {

        $book = new Books();
        $result = $book->listAscending();
    }
    // Similarly you can call other functions here adding more elseif block

} while ($userChoice != "exit");